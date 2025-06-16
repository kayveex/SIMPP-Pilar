<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

if (!function_exists('create_notification')) {
    function create_notification(string $title, string $message, string $type = 'info', $userId = null)
    {
        try {
            $notif = Notification::create([
                'user_id' => $userId ?? (Auth::id() ?? 1), // gunakan default jika tidak ada Auth
                'title' => $title,
                'message' => $message,
                'type' => $type,
                'is_read' => false,
            ]);

            if (function_exists('toast')) {
                toast($notif->message, $notif->type);
            }

            return $notif;
        } catch (\Throwable $e) {
            return null;
        }
    }
}
