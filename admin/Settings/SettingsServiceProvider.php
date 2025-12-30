<?php

declare(strict_types=1);

namespace Admin\Settings;

use Illuminate\Support\ServiceProvider;

final class SettingsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        $this->loadViewsFrom(__DIR__.'/Views', 'settings');

        $this->app->register(RouteServiceProvider::class);
    }
}
