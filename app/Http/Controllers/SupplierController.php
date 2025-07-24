<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Constants\ResponseCode;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function view(Request $request) {

        $title_page = 'Quản lý nhà cung cấp';

        $suppliers = Supplier::orderBy('ord', 'asc')->paginate(10);

        return view('suppliers.view', compact('suppliers', 'title_page'));
    }

    // Display form create
    public function create()
    {
        return view('suppliers.add');
    }

    // Insert
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $code = $this->generateSupplierCode();
            $slug = Str::slug('nha-san-xuat-' . $code);

            $supplier = Supplier::create([
                'name' => $validated['name'],
                'code' => $code,
                'slug' => $slug,
                'short_content' => $request->short_content ?? null,
                'ord' => $request->ord ?? 0,
                'act' => $request->act ?? 1
            ]);

            // Lấy ID vừa thêm
            $id = $supplier->id;

            return response()->json([
                'code' => ResponseCode::SUCCESS,
                'message' => 'Thêm mới thành công!',
                'url' => route('supplier.view')
            ]);
        } catch (\Exception $e) {
            Log::error('Lỗi khi thêm mới!: '.$e->getMessage());

            return response()->json([
                'code' => ResponseCode::ERROR,
                'message' => 'Thêm mới thất bại!',
                'url' => ''
            ]);
        }
    }

    // Display form edit
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('suppliers.edit', compact('supplier'));
    }

    // Edit
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $supplier = Supplier::findOrFail($id);

            $supplier->update([
                'name' => $validated['name'],
                'short_content' => $request->short_content ?? null
            ]);

            return response()->json([
                'code' => ResponseCode::SUCCESS,
                'message' => 'Cập nhật thành công!',
                'url' => ''
            ]);

        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật!: '.$e->getMessage());

            return response()->json([
                'code' => ResponseCode::ERROR,
                'message' => 'Cập nhật thất bại!',
                'url' => ''
            ]);
        }
    }

    // delete data ID
    public function destroy($id)
    {
        try {

            $supplier = Supplier::findOrFail($id);
            $supplier->delete();

            return redirect()->back()->with('success', 'Đã xoá nhà sản xuất!');

        } catch (\Exception $e) {

            Log::error('Lỗi khi cập nhật!: '.$e->getMessage());

            return redirect()->back()->with('error', 'Lỗi xoá nhà sản xuất!');

        }
    }

    // get data table ID
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('suppliers.detail', compact('supplier'));
    }

    public function generateSupplierCode()
    {
        $prefix = 'NSX';
        $random = rand(100, 999); // 3 chữ số
        $date = now()->format('dmY'); // ddmmyyyy

        return $prefix . $random . $date;
    }
}
