<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Additional imports
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    function login() {
        return view('pages.user.login');
    }

    function doLogin(Request $request) {
        // Buat validator manual
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6|max:16',
        ]);

        // Jika validasi gagal, kembalikan semua error
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Coba login
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('home')->with('success', 'Sign in berhasil');
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email yang anda masukkan tidak terdaftar!',
            'password' => 'Password anda salah!',
        ])->withInput();
    }

    function logout() {
        Auth::logout();
        return redirect('/')->with('success', 'Sign out berhasil');
    }
}
