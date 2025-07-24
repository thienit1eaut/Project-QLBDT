<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Employee;

class OrderController extends Controller {

    public function index() {

        $title_page = 'Quản lý đơn hàng';

        $orders = Order::with('employee')->latest()->get();
        return view('orders.view', compact('orders', 'title_page'));
    }

    public function create() {

        $products = Product::where('act', 1)->where('quantity', '>', 0)->get();

        $employee = Employee::where('user_id', Auth::id())->first();
        if (!$employee) {
            return back()->with('error', 'Không tìm thấy thông tin nhân viên.');
        }

        return view('orders.create', compact('products', 'employee'));
    }

    public function store(Request $request) {

        $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'nullable|string|max:20',
            'customer_address' => 'nullable|string|max:255',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|integer|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.unit_price' => 'required|numeric|min:0',
        ]);

        $employee = Employee::where('user_id', Auth::id())->first();
        if (!$employee) {
            return back()->with('error', 'Không tìm thấy thông tin nhân viên.');
        }

        DB::beginTransaction();
        try {
            // Tính tổng
            $totalQuantity = 0;
            $totalPrice = 0;

            // Sinh mã đơn hàng (ví dụ: HD20250723001)
            $orderCode = 'HD' . now()->format('Ymd') . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);

            $order = Order::create([
                'order_code' => $orderCode,
                'employee_id' => $employee->id,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'note' => $request->note,
                'status' => 'completed',
                'act' => 1,
            ]);

            foreach ($request->products as $item) {
                $product = Product::find($item['product_id']);

                if ($product->quantity < $item['quantity']) {
                    throw new \Exception("Sản phẩm {$product->name} không đủ tồn kho.");
                }

                // Trừ kho
                $product->quantity -= $item['quantity'];
                $product->save();

                $intoMoney = $item['quantity'] * $item['unit_price'];

                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'into_money' => $intoMoney,
                    'note' => $item['note'] ?? null,
                ]);

                $totalQuantity += $item['quantity'];
                $totalPrice += $intoMoney;
            }

            // Cập nhật tổng đơn
            $order->update([
                'total_quantity' => $totalQuantity,
                'total_price' => $totalPrice,
            ]);

            DB::commit();

            return response()->json([
                'code' => 200,
                'message' => 'Tạo đơn hàng thành công!',
                'url' => route('orders.index')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Lỗi khi tạo đơn hàng: ' . $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    public function print(Order $order) {
        $order->load('orderDetails.product', 'employee');
        $pdf = Pdf::loadView('orders.print', compact('order'));
        return $pdf->stream("don_hang_{$order->order_code}.pdf");
    }
}
