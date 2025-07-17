<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function view(Request $request) {
        $data = [
            'title_page' => 'Quản lý nhà sản xuất'
        ];

        $suppliers = Supplier::orderBy('ord', 'asc')->paginate(10);

        return view('suppliers.view', compact('suppliers'));
    }

    // Display form create
    public function create()
    {
        return view('suppliers.add');
    }

    // Insert
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $code = $this->generateSupplierCode();
        $slug = 'nha-san-xuat'.$code;

        Supplier::create([
            'name' => $request->name,
            'code' => $code,
            'slug' => $slug,
            //'img' => $request->img,
            'short_content' => $request->short_content,
            //'content' => "",
            'parent' => $request->parent ?? 0,
            'ord' => $request->ord ?? 0,
            'act' => $request->act ?? 1,
            'home' => $request->home ?? 0
        ]);

        return redirect()->back()->with('success', 'Đã thêm danh mục!');
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
        $category = Supplier::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $code = $request->code;
        $slug = 'danh-muc-'.$code;

        $category->update([
            'name' => $request->name,
            'slug' => $slug,
            //'img' => $request->img,
            'short_content' => $request->short_content,
            //'content' => $request->content,
            'parent' => $request->parent ?? 0,
            'ord' => $request->ord ?? 0,
            'act' => $request->act ?? 1
        ]);

        return redirect()->back()->with('success', 'Đã cập nhật danh mục!');
    }

    // delete data ID
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->back()->with('success', 'Đã xoá danh mục!');
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
