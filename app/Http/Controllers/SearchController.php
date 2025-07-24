<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Employee;
use App\Models\User;

class SearchController extends Controller
{
    public function index(Request $request) {
        
        $keyword = $request->input('search');
        $category = $request->input('id_cate');
        $title_page = 'Tìm kiếm ';
        $listdata = [];
        $view_search = '';

        switch ($category) {
            case 1: // Danh mục
                $listdata = ProductCategory::where('name', 'like', "%{$keyword}%")->orWhere('code', 'like', "%{$keyword}%")->get();
                $title_page = 'Tìm kiếm danh mục với từ khóa: '.$keyword;
                $view_search = 'product-categories.search';
                break;
            case 2: // Sản phẩm
                $listdata = Product::where('name', 'like', "%{$keyword}%")->orWhere('code', 'like', "%{$keyword}%")->get();
                $title_page = 'Tìm kiếm sản phẩm với từ khóa: '.$keyword;
                $view_search = 'products.search';
                break;
            case 3: // Nhà sản xuất
                $listdata = Supplier::where('name', 'like', "%{$keyword}%")->orWhere('code', 'like', "%{$keyword}%")->get();
                $title_page = 'Tìm kiếm nhà sản xuất với từ khóa: '.$keyword;
                $view_search = 'suppliers.search';
                break;
            case 4: // Nhân viên
                $listdata = Employee::where('name', 'like', "%{$keyword}%")->orWhere('email', 'like', "%{$keyword}%")->get();
                $title_page = 'Tìm kiếm nhân viên với từ khóa: '.$keyword;
                $view_search = 'employees.search';
                break;
            case 5: // Tài khoản
                $listdata = User::where('name', 'like', "%{$keyword}%")->orWhere('email', 'like', "%{$keyword}%")->get();
                $title_page = 'Tìm kiếm tài khoản với từ khóa: '.$keyword;
                $view_search = 'users.search';
                break;
        }

        return view($view_search, compact('listdata', 'category', 'keyword'));
    }
}
