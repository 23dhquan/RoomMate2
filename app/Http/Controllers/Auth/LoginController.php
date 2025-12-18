<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.sign-in');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                if ($user->status == 1){
                    if ($user->role === 'admin') {
                        return redirect()->route('dashboard')->with('success', 'Chào mừng Admin!');
                    } elseif ($user->role === 'tenant') {
                        return redirect()->route('bill.filter')->with('success', 'Chào mừng Tenant!');
                    }
                }
                else{
                    return back()->withErrors([
                        'email' => 'Tài khoản của bạn đang bị khóa',
                    ]);
                }
            }


            Auth::logout();
            return back()->withErrors([
                'email' => 'Quyền truy cập không hợp lệ.',
            ]);
        }

        return back()->withErrors([
            'email' => 'Sai thông tin đăng nhập.',
        ]);
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/auth/login');
    }
}
