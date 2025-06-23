<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    // index page for user account management
    public function index(Request $request)
    {
        $query = User::query();

        // Filter: Search by name or email
        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(email) LIKE ?', ["%{$search}%"]);
            });
        }

        // Filter: Role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('pages.user.index', compact('users'));
    }

    // show the add form

    public function create()
    {
        return view('pages.user.create');
    }

    // store a new user account
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
            'photo' => 'nullable|image', // Optional photo upload
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        // Handle photo upload if provided
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $user->photo = $path;
            $user->save();
        }

        create_notification(
            'Akun User Dibuat',
            Auth::user()->name . ' telah membuat akun user baru: ' . $user->name,
            'success',
            Auth::id(),
        );

        return redirect()->route('user.index')->with('success', 'User account created successfully.');
    }
}
