<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function editProfile($userId)
    {
        $userData = User::findOrFail($userId);

        return view('pages.user.editprofile', compact('userData'));
    }
}
