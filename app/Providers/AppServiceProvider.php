<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Visitor;

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
        View::composer('layouts.app', function ($view) {
            try {
                $monthlyVisitors = Visitor::whereMonth('created_at', now()->month)
                                        ->whereYear('created_at', now()->year)
                                        ->distinct('ip_address')
                                        ->count('ip_address');
            } catch (\Exception $e) {
                $monthlyVisitors = 0;
            }
            $view->with('monthlyVisitors', $monthlyVisitors);
        });
    }
}
