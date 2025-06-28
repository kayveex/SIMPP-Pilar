<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

if (!function_exists('create_notification')) {
    /**
     * Buat notifikasi.
     *
     * @param string $title
     * @param string $message
     * @param string $type
     * @param int|null $userId
     * @param string|null $targetRole
     * @return Notification|null
     */
    function create_notification(string $title, string $message, string $type = 'info', $userId = null, string $targetRole = null)
    {
        try {
            $data = [
                'user_id' => $userId ?? (Auth::id() ?? 1),
                'title' => $title,
                'message' => $message,
                'type' => $type,
                'is_read' => false,
            ];

            if ($targetRole !== null) {
                $data['target_role'] = $targetRole;
            }

            $notif = Notification::create($data);

            if (function_exists('toast')) {
                toast($notif->message, $notif->type);
            }

            return $notif;
        } catch (\Throwable $e) {
            return null;
        }
    }
}
