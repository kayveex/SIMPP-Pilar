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
        // 4. Notifikasi global (untuk seluruh user, bukan hanya untuk role tertentu)
        $globalNotifications = Notification::where('user_id', '!=', $user->id)
            ->orderByDesc('created_at')
            ->paginate(5, ['*'], 'global_page');

        return view('pages.notify.index', compact(
            'personalUnread',
            'personalRead',
            'divisionNotif',
            'globalNotifications'
        ));
    }

    public function markAsRead(Request $request, $id)
    {
        $user = Auth::user();

        // Cari notifikasi spesifik yang belum dibaca,
        // dan ditujukan ke user ini ATAU ke role-nya
        $notification = Notification::where('notif_id', $id)
            ->where('is_read', false)
            ->where(function($q) use ($user) {
                $q->where('user_id',     $user->id)
                ->orWhere('target_role', $user->role);
            })
            ->first();

        if (! $notification) {
            return response()->json(['error' => 'Notification not found'], 404);
        }

        $notification->update(['is_read' => true]);

        if ($request->ajax()) {
            return response()->json(['success' => 'Notification marked as read']);
        }

        return redirect()->back()
            ->with('success', 'Notifikasi berhasil ditandai sebagai sudah dibaca');
    }


    public function markAllAsRead(Request $request)
    {
        $user = Auth::user();

        // Hanya update notification yang masih unread
        // DAN ditujukan ke user ini ATAU ke role-nya
        $updatedCount = Notification::where('is_read', false)
            ->where(function($q) use ($user) {
                $q->where('user_id',     $user->id)
                ->orWhere('target_role', $user->role);
            })
            ->update(['is_read' => true]);

        if ($request->ajax()) {
            return response()->json([
                'success' => 'All notifications marked as read',
                'count'   => $updatedCount,
            ]);
        }

        return redirect()->back()
            ->with('success', "Sebanyak {$updatedCount} notifikasi berhasil ditandai sebagai sudah dibaca");
    }

}
