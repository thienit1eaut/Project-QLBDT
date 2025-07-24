<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Constants\ResponseCode;
use App\Models\ImportProduct;
use App\Models\ImportDetailProduct;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class ImportProductController extends Controller
{
    public function index() {

        $title_page = 'Quản lý nhập hàng';

        $imports = ImportProduct::with('employee', 'supplier')->latest()->get();
        return view('imports.view', compact('imports', 'title_page'));
    }

    public function create() {

        $products = Product::all();
        $suppliers = Supplier::all();
        // $employees = Employee::all();

        $employee = Employee::where('user_id', Auth::id())->first();
        if (!$employee) {
            return back()->with('error', 'Không tìm thấy thông tin nhân viên.');
        }

        return view('imports.create', compact('products', 'suppliers', 'employee'));
    }

    public function store(Request $request) {

        $request->validate([
            'products' => 'required|array',
            'products.*.product_id' => 'required|integer',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.import_price' => 'required|numeric|min:0',
        ]);

        // $employee = Employee::where('user_id', Auth::id())->first();
        // if (!$employee) {
        //     return response()->json([
        //         'code' => ResponseCode::ERROR, 'message' => 'Không tìm thấy thông tin nhân viên.!', 'url' => ''
        //     ]);
        // }

        DB::transaction(function () use ($request) {
            $totalQty = 0;
            $totalPrice = 0;

            $import = ImportProduct::create([
                'code' => $this->generateImportProductCode(),
                'employee_id' => $request->employee_id,
                'supplier_id' => $request->supplier_id,
                //'note' => $request->note,
                'status' => 'completed',
            ]);

            foreach ($request->products as $item) {
                ImportDetailProduct::create([
                    'import_id' => $import->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'import_price' => $item['import_price'],
                    //'note' => $item['note'] ?? null,
                ]);

                // Cập nhật tồn kho
                $product = Product::find($item['product_id']);
                $product->quantity += $item['quantity'];
                $product->save();

                $totalQty += $item['quantity'];
                $totalPrice += $item['quantity'] * $item['import_price'];
            }

            $import->update([
                'total_quantity' => $totalQty,
                'total_price' => $totalPrice,
            ]);
        });

        return response()->json([
            'code' => ResponseCode::SUCCESS,
            'message' => 'Tạo phiếu nhập hàng thành công.!',
            'url' => route('imports.index')
        ]);
    }

    public function generateImportProductCode() {
        $prefix = 'PHIEUNHAP';
        $random = rand(100, 999); // 3 chữ số
        $date = now()->format('dmY'); // ddmmyyyy

        return $prefix . $random . $date;
    }

    public function print(ImportProduct $import) {
        $import->load('importDetails.product', 'employee');
        $pdf = Pdf::loadView('imports.print', compact('import'));
        return $pdf->stream("don_nhap_hang_{$import->code}.pdf");
    }
}
