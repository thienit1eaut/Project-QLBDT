<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('auth.login');  // Giao diện form login
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ], [
            'login.required' => 'Vui lòng nhập tên đăng nhập hoặc email.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        $login_type = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $user = User::where($login_type, $request->login)->where('act', 1)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['login' => 'Tên đăng nhập hoặc mật khẩu không đúng.']);
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed', // cần có input password_confirmation
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'id_role' => $request->role,
            'email' => $request->email,
            'note' => $request->note,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user); // đăng nhập luôn sau khi đăng ký

        return redirect('/dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
