<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;
use App\Models\Employee;
use App\Models\User;

class DashboardController extends Controller
{
    public function index() {
        $title_page = 'Bảng điều khiển';

        $user = Auth::user();

        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCategories = ProductCategory::count();
        $totalSuppliers = Supplier::count();
        $totalEmployees = Employee::count();
        $totalUsers = User::count();

        return view('main', compact(
            'user',
            'title_page',
            'totalOrders',
            'totalProducts',
            'totalCategories',
            'totalSuppliers',
            'totalEmployees',
            'totalUsers'
        ));
    }
}
