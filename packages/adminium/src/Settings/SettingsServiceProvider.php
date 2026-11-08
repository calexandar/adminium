<?php

declare(strict_types=1);

namespace Calexandar\Adminium\Settings;

use Illuminate\Support\ServiceProvider;

final class SettingsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->loadViewsFrom(__DIR__.'/Views', 'settings');

        $this->app->register(RouteServiceProvider::class);
    }
}
