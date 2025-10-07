<?php

declare(strict_types=1);

namespace Admin\Dashboard;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as BaseServiceProvider;
use Illuminate\Support\Facades\Route;

final class RouteServiceProvider extends BaseServiceProvider
{
    /**
     * Define the routes for the application.
     */
    public function boot(): void
    {
        $this->routes(function (): void {
            Route::middleware(['web', 'auth'])
                ->prefix('admin')
                ->group(__DIR__.'/dashboard-routes.php');
        });
    }
}
