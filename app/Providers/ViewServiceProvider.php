<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\Project;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register SweetAlert view namespace
        $this->loadViewsFrom(resource_path('views/vendor/sweetalert'), 'sweetalert');
        
        // View composer global untuk semua view ('*')
        View::composer('*', function ($view) {
            if (! Auth::check()) {
                return;
            }

            $userId = Auth::id();

            try {
                // notifikasi
                $myNotif = Notification::where('user_id', $userId)
                    ->where('is_read', false)
                    ->orderByDesc('created_at')
                    ->take(3)
                    ->get();

                $countMyNotif = Notification::where('user_id', $userId)
                    ->where('is_read', false)
                    ->count();

                // proyek yang berakhir dalam 7 hari ke depan, belum 'selesai'
                $reminderProyek = Project::where('status','!=','selesai')
                    ->whereBetween('estimated_end_date',[ now(), now()->addDays(7) ])
                    ->with(['phases' => function($q){
                        $q->where(function($q2){
                                $q2->where('is_completed', false)
                                ->orWhereNull('is_completed');
                            })
                        ->whereBetween('estimated_end_date',[ now(), now()->addDays(7) ])
                        ->orderBy('estimated_end_date','asc');
                    }])
                    ->orderBy('estimated_end_date','asc')
                    // ↑ kalau limit(5) bikin susah debugging, comment dulu untuk testing
                    ->limit(5)
                    ->get();

                

                
                // print $reminderProyek ke log

  
                // Hitung total fase 
                $reminderNotifCount = $reminderProyek->sum(fn($p) => $p->phases->count());

            } catch (\Exception $e) {
                // fallback
                $myNotif = collect();
                $countMyNotif = 0;
                $reminderProyek = collect();
            }

            // kirim data
            $view->with([
                'myNotif'        => $myNotif,
                'countMyNotif'   => $countMyNotif,
                'reminderProyek' => $reminderProyek,
                'reminderNotifCount' => $reminderNotifCount,
            ]);
        });
    }
}
