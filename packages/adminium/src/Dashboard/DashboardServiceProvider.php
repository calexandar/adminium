<?php

declare(strict_types=1);

namespace Calexandar\Adminium\Dashboard;

use Illuminate\Support\ServiceProvider;

final class DashboardServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        $this->loadViewsFrom(__DIR__.'/Views', 'dashboard');

        $this->app->register(RouteServiceProvider::class);
    }
}
