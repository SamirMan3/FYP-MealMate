<?php

namespace App\Providers;


use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        view()->composer('*', function ($view) {
            $user = Auth::user();
            if ( $user) {
                $unreadNotifications = $user->unreadNotifications;
                $view->with('unread_notification', $unreadNotifications);
            }

            $view->with('auth_user', Auth::user());

            // $view->with('social_sites', SocialSites::all());
            // $view->with('about_swastik', AboutUs::where('route', 'about')->first());
            // $view->with('message_from_chairperson', AboutUs::where('route', 'message_from_chairman')->first());
            // $view->with('faculty',Faculty::where('is_active', 1)->get());
            // $view->with('programs',Program::where('is_active', 1)->get());

        });
    }
}
