<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $notifications = [
            [
                'user_id' => 1,
                'title' => 'Proyek Baru Ditambahkan',
                'message' => 'Proyek Pembangunan Jembatan Ciliwung telah ditambahkan ke sistem.',
                'type' => 'info',
                'is_read' => false,
                'url' => '/projects/1',
                'target_role' => 'Divisi Admin',
                'created_at' => Carbon::now()->subHours(2),
                'updated_at' => Carbon::now()->subHours(2)
            ],
            [
                'user_id' => 1,
                'title' => 'Material Request Disetujui',
                'message' => 'Pengajuan material untuk Proyek A telah disetujui oleh divisi purchasing.',
                'type' => 'success',
                'is_read' => false,
                'url' => '/material/view/1',
                'target_role' => 'Divisi Admin',
                'created_at' => Carbon::now()->subHours(5),
                'updated_at' => Carbon::now()->subHours(5)
            ],
            [
                'user_id' => 1,
                'title' => 'Deadline Proyek Mendekat',
                'message' => 'Proyek Renovasi Gedung Perkantoran akan berakhir dalam 7 hari.',
                'type' => 'warning',
                'is_read' => false,
                'url' => '/projects/2',
                'target_role' => 'Divisi Admin',
                'created_at' => Carbon::now()->subHours(1),
                'updated_at' => Carbon::now()->subHours(1)
            ],
            [
                'user_id' => 1,
                'title' => 'Laporan Progress Diterima',
                'message' => 'Laporan progress proyek Green Valley telah diterima dan sedang direview.',
                'type' => 'info',
                'is_read' => true,
                'url' => '/progress-proyek/view/3',
                'target_role' => 'Divisi Admin',
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subHours(6)
            ],
            [
                'user_id' => 1,
                'title' => 'Budget Exceeded',
                'message' => 'Anggaran proyek PLTU Muara Karang telah melebihi estimasi awal.',
                'type' => 'error',
                'is_read' => true,
                'url' => '/anggaran-proyek/detail/5',
                'target_role' => 'Divisi Admin',
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(1)
            ],
            [
                'user_id' => 2, // Different user for division notifications
                'title' => 'Material Baru Tersedia',
                'message' => 'Material besi beton 12mm telah tersedia di gudang.',
                'type' => 'info',
                'is_read' => false,
                'url' => '/material',
                'target_role' => 'Divisi Teknikal',
                'created_at' => Carbon::now()->subHours(3),
                'updated_at' => Carbon::now()->subHours(3)
            ],
            [
                'user_id' => 3, // Different user for division notifications
                'title' => 'Invoice Material Menunggu Pembayaran',
                'message' => 'Invoice INV-5678 untuk material semen menunggu konfirmasi pembayaran.',
                'type' => 'warning',
                'is_read' => false,
                'url' => '/material/view/2',
                'target_role' => 'Divisi Purchasing',
                'created_at' => Carbon::now()->subHours(4),
                'updated_at' => Carbon::now()->subHours(4)
            ]
        ];

        Notification::insert($notifications);
    }
}
