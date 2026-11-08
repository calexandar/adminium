<?php

declare(strict_types=1);

namespace Calexandar\Adminium\Dashboard;

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
            Route::middleware(['web', 'adminium.auth'])
                ->prefix(config('adminium.route_prefix', 'admin'))
                ->group(__DIR__.'/dashboard-routes.php');
        });
    }
}
