<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Constants\ResponseCode;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    public function view(Request $request) {
        
        $title_page = 'Quản lý danh mục';

        $categories = ProductCategory::orderBy('ord', 'asc')->paginate(3);

        return view('product-categories.view', compact('categories', 'title_page'));
    }

    // Display form create
    public function create() {
        $parentCategories = ProductCategory::orderBy('ord')->get();

        return view('product-categories.add', compact('parentCategories'));
    }

    // Insert
    public function store(Request $request) {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ],[
            'name.required' => 'Vui lòng nhập tên danh mục!',
        ]);

        try {
            $code = $this->generateCategoryCode();
            $slug = Str::slug('danh-muc-'.$code);

            $product_category = ProductCategory::create([
                'name' => $validated['name'],
                'code' => $code,
                'slug' => $slug,
                'short_content' => $request->short_content,
                'parent' => $request->parent ?? 0,
                'ord' => $request->ord ?? 0,
                'act' => $request->act ?? 1
            ]);

            return response()->json([
                'code' => ResponseCode::SUCCESS,
                'message' => 'Thêm mới thành công!',
                'url' => route('category.view')
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
    public function edit($id) {
        $category = ProductCategory::findOrFail($id);
        $parentCategories = ProductCategory::where('id', '!=', $id)->orderBy('ord')->get();

        return view('product-categories.edit', compact('category', 'parentCategories'));
    }


    // Edit
    public function update(Request $request, $id) {

        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ],[
            'name.required' => 'Vui lòng nhập tên danh mục!',
        ]);

        try {
            $category = ProductCategory::findOrFail($id);

            $category->update([
                'name' => $validated['name'],
                'short_content' => $request->short_content,
                'parent' => $request->parent ?? 0,
                'ord' => $request->ord ?? 0,
                'act' => $request->act ?? 1
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
    public function destroy($id) {
        try {
            $category = ProductCategory::findOrFail($id);
            $category->delete();

            return redirect()->back()->with('success', 'Đã xoá danh mục!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật!: '.$e->getMessage());

            return redirect()->back()->with('error', 'Lỗi xoá danh mục!');
        }
    }

    // get data table ID
    public function show($id) {
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
