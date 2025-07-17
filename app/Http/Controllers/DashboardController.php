<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $data = [
            'title_page' => 'Bảng điều khiển'
        ];

        return view('main', $data);
    }
}
