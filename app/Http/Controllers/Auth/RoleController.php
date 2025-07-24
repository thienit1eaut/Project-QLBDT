<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    // Display form create
    public function showFormCreate()
    {
        return view('roles.add');
    }

    // Insert
    public function store(Request $request)
    {
        Role::create([
            'name' => $request->name,
            'code' => $request->code,
            'note' => $request->note,
            'ord' => $request->ord ?? 0,
            'act' => $request->ord ?? 0
        ]);

        return redirect()->back()->with('success', 'Đã thêm danh mục!');
    }
}
