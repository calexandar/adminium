<?php

declare(strict_types=1);

namespace Admin\Articles;

use Illuminate\Support\ServiceProvider;

final class ArticlesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        $this->loadViewsFrom(__DIR__.'/Views', 'articles');
        $this->loadMigrationsFrom(__DIR__.'/Migrations');

        $this->app->register(RouteServiceProvider::class);
    }
}
