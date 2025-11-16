<?php

declare(strict_types=1);

namespace Admin\Media;

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
            Route::middleware(['web', 'auth', 'can:manage_media'])
                ->prefix('admin')
                ->name('admin.')
                ->group(__DIR__.'/media-routes.php');
        });
    }
}
