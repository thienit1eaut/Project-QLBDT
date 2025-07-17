<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Supplier;
use App\Models\Product;

class ProductController extends Controller
{
    public function view(Request $request) {
        $data = [
            'title_page' => 'Quản lý sản phẩm'
        ];

        $products = Product::orderBy('ord', 'asc')->paginate(10);

        return view('products.view', compact('products'));
    }

    // Display form create
    public function create()
    {
        $parentProducts = ProductCategory::orderBy('ord')->get();
        $parentSuppliers = Supplier::orderBy('ord')->get();

        return view('products.add', compact('parentProducts','parentSuppliers'));
    }

    // Insert
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $code = $this->generateProductCode();
        $slug = 'san-pham-'.$code;

        Product::create([
            'name' => $request->name,
            'code' => $code,
            'slug' => $slug,
            //'img' => $request->img,
            'price' => $request->price,
            'status' => 0,
            'quantity' => 0,
            'short_content' => $request->short_content,
            'content' => $request->content,
            'id_category' => $request->id_category ?? 0,
            'id_supplier' => $request->id_supplier ?? 0,
            'ord' => $request->ord ?? 0,
            'act' => $request->act == 'on' ? 1 : 0
        ]);

        return redirect()->back()->with('success', 'Đã thêm danh mục!');
    }

    // Display form edit
    public function edit($id)
    {
        $dataitem = Product::findOrFail($id);
        $parentCategories = ProductCategory::orderBy('ord')->get();
        $parentSuppliers = Supplier::orderBy('ord')->get();

        return view('products.edit', compact('dataitem', 'parentCategories', 'parentSuppliers'));
    }


    // Edit
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $product->update([
            'name' => $request->name,
            //'slug' => $slug,
            //'img' => $request->img,
            'price' => $request->price,
            'short_content' => $request->short_content,
            'content' => $request->content,
            'id_category' => $request->id_category ?? 0,
            'id_supplier' => $request->id_category ?? 0,
            'ord' => $request->ord ?? 0,
            'act' => $request->act == 'on' ? 1 : 0
        ]);

        return redirect()->back()->with('success', 'Đã cập nhật danh mục!');
    }

    // delete data ID
    public function destroy($id)
    {
        $category = ProductCategory::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Đã xoá danh mục!');
    }

    // get data table ID
    public function show($id)
    {
        $category = ProductCategory::findOrFail($id);

        return view('product-categories.detail', compact('category'));
    }

    public function generateProductCode()
    {
        $prefix = 'SP';
        $random = rand(100, 999); // 3 chữ số
        $date = now()->format('dmY'); // ddmmyyyy

        return $prefix . $random . $date;
    }
}
