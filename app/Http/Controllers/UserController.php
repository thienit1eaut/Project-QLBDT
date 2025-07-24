<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function view(Request $request) {
        
        $title_page = 'Quản lý tài khoản';

        $users = User::orderBy('created_at', 'desc')->paginate(10);

        return view('users.view', compact('users', 'title_page'));
    }
}
