<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Additional imports
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function login() {
        return view('pages.user.login');
    }

    function doLogin(Request $request) {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($data)) {
            // if login success, redirect to home page
            return redirect()->route('home')->with('success', 'Sign in berhasil');
        }else {
            // redirect back to login page '/' with error message
            return redirect('/')->with('error', 'Email atau Password salah');
        }
    }

    function logout() {
        Auth::logout();
        return redirect('/')->with('success', 'Sign out berhasil');
    }
}
