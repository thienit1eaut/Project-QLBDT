<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Constants\ResponseCode;
use App\Models\ProductCategory;
use App\Models\Supplier;
use App\Models\Product;

class ProductController extends Controller
{
    public function view(Request $request) {
        
        $title_page = 'Quản lý sản phẩm';

        $products = Product::with(['category', 'supplier'])->orderBy('created_at', 'desc')->paginate(10);

        return view('products.view', compact('products', 'title_page'));
    }

    // Display form create
    public function create()
    {
        $parentProducts = ProductCategory::orderBy('ord')->get();
        $parentSuppliers = Supplier::orderBy('ord')->get();

        return view('products.add', compact('parentProducts','parentSuppliers'));
    }

    // Insert
    public function store(Request $request) {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'id_category' => 'nullable|integer|exists:product_categories,id',
            'id_supplier' => 'nullable|integer|exists:suppliers,id',
        ],[
            'name.required' => 'Vui lòng nhập tên sản phẩm!',
            'price.required' => 'Vui lòng nhập giá sản phẩm!',
            'id_category.required' => 'Vui lòng Chọn danh mục!',
            'id_supplier.required' => 'Vui lòng Chọn nhà sản xuất!',
        ]);

        try {
            $code = $this->generateProductCode();
            $slug = Str::slug('san-pham-'.$code);

            $product = Product::create([
                'name' => $validated['name'],
                'code' => $code,
                'slug' => $slug,
                'price' => $validated['price'] ?? 0.0,
                'status' => 0,
                'quantity' => 0,
                'short_content' => $request->short_content,
                'content' => $request->content,
                'id_category' => $validated['id_category'] ?? 0,
                'id_supplier' => $validated['id_supplier'] ?? 0
            ]);

            $id = $product->id;

            return response()->json([
                'code' => ResponseCode::SUCCESS,
                'message' => 'Thêm mới thành công!',
                'url' => route('product.view')
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

        $dataitem = Product::findOrFail($id);
        $parentCategories = ProductCategory::orderBy('ord')->get();
        $parentSuppliers = Supplier::orderBy('ord')->get();

        return view('products.edit', compact('dataitem', 'parentCategories', 'parentSuppliers'));
    }

    // Edit
    public function update(Request $request, $id) {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'id_category' => 'nullable|integer|exists:product_categories,id',
            'id_supplier' => 'nullable|integer|exists:suppliers,id',
        ],[
            'name.required' => 'Vui lòng nhập tên sản phẩm!',
            'price.required' => 'Vui lòng nhập giá sản phẩm!',
            'id_category.required' => 'Vui lòng Chọn danh mục!',
            'id_supplier.required' => 'Vui lòng Chọn nhà sản xuất!',
        ]);

        try {
            $product = Product::findOrFail($id);

            $product->update([
                'name' => $validated['name'],
                'price' => $validated['price'] ?? 0.0,
                'short_content' => $request->short_content,
                'content' => $request->content,
                'id_category' => $validated['id_category'] ?? 0,
                'id_supplier' => $validated['id_supplier'] ?? 0,
                'act' => $request->act
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

            $product = Product::findOrFail($id);
            $product->delete();

            return redirect()->back()->with('success', 'Đã xoá sản phẩm!');

        } catch (\Exception $e) {

            Log::error('Lỗi khi cập nhật!: '.$e->getMessage());

            return redirect()->back()->with('error', 'Lỗi xoá sản phẩm!');
            
        }
    }

    // get data table ID
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.detail', compact('dataitem'));
    }

    public function generateProductCode()
    {
        $prefix = 'SP';
        $random = rand(100, 999); // 3 chữ số
        $date = now()->format('dmY'); // ddmmyyyy

        return $prefix . $random . $date;
    }
}
