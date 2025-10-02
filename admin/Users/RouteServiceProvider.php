<?php

declare(strict_types=1);

namespace Admin\Users;

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
            Route::middleware(['web', 'auth', 'can:manage_users'])
                ->prefix('admin')
                ->group(__DIR__.'/users-routes.php');
        });
    }
}
