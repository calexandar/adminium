<?php

declare(strict_types=1);

namespace Calexandar\Adminium\Pages;

use Illuminate\Support\ServiceProvider;

final class PagesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        $this->loadViewsFrom(__DIR__.'/Views', 'pages');
        $this->loadMigrationsFrom(__DIR__.'/Migrations');

        $this->app->register(RouteServiceProvider::class);
    }
}
