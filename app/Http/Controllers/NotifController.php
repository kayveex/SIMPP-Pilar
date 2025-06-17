<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Notifikasi pribadi: unread
        $personalUnread = Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->orderByDesc('created_at')
            ->paginate(5, ['*'], 'personal_unread_page');

        // 2. Notifikasi pribadi: read
        $personalRead = Notification::where('user_id', $user->id)
            ->where('is_read', true)
            ->orderByDesc('created_at')
            ->paginate(5, ['*'], 'personal_read_page');

        // 3. Notifikasi dari divisi yang sama (user lain dengan role yang sama)
        $divisionNotif = Notification::whereHas('user', function ($q) use ($user) {
                $q->where('role', $user->role)
                  ->where('id', '!=', $user->id); // selain dirinya sendiri
            })
            ->orderByDesc('created_at')
            ->paginate(10, ['*'], 'division_page');

        return view('pages.notify.index', compact(
            'personalUnread',
            'personalRead',
            'divisionNotif'
        ));
    }
}
