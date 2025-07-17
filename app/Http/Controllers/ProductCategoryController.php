<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    public function view(Request $request) {
        $data = [
            'title_page' => 'Quản lý danh mục sản phẩm'
        ];

        $categories = ProductCategory::orderBy('ord', 'asc')->paginate(10);

        return view('product-categories.view', compact('categories'));
    }

    // Display form create
    public function create()
    {
        $parentCategories = ProductCategory::orderBy('ord')->get();

        return view('product-categories.add', compact('parentCategories'));
    }

    // Insert
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $code = $this->generateCategoryCode();
        $slug = 'danh-muc-'.$code;

        ProductCategory::create([
            'name' => $request->name,
            'code' => $code,
            'slug' => $slug,
            //'img' => $request->img,
            'short_content' => $request->short_content,
            //'content' => "",
            'parent' => $request->parent ?? 0,
            'ord' => $request->ord ?? 0,
            'act' => $request->act ?? 1
        ]);

        return redirect()->back()->with('success', 'Đã thêm danh mục!');
    }

    // Display form edit
    public function edit($id)
    {
        $category = ProductCategory::findOrFail($id);
        $parentCategories = ProductCategory::where('id', '!=', $id)->orderBy('ord')->get();

        return view('product-categories.edit', compact('category', 'parentCategories'));
    }


    // Edit
    public function update(Request $request, $id)
    {
        $category = ProductCategory::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category->update([
            'name' => $request->name,
            //'slug' => $slug,
            //'img' => $request->img,
            'short_content' => $request->short_content,
            //'content' => $request->content,
            'parent' => $request->parent ?? 0,
            'ord' => $request->ord ?? 0,
            'act' => $request->act ?? 1,
            'home' => $request->home ?? 0
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

    public function generateCategoryCode()
    {
        $prefix = 'DMSP';
        $random = rand(100, 999); // 3 chữ số
        $date = now()->format('dmY'); // ddmmyyyy

        return $prefix . $random . $date;
    }

}
