<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

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
            if (Auth::check()) {
                $userId = Auth::id();

                $myNotif = Notification::where('user_id', $userId)
                    ->where('is_read', false)
                    ->latest()
                    ->paginate(3);

                $countMyNotif = Notification::where('user_id', $userId)
                    ->where('is_read', false)
                    ->count();

                // Kirim data ke view
                $view->with([
                    'myNotif' => $myNotif,
                    'countMyNotif' => $countMyNotif,
                ]);
            }
        });
    }
}
