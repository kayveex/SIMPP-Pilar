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

        dd($data);
    }
}
