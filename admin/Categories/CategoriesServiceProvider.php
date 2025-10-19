<?php

declare(strict_types=1);

namespace Admin\Categories;

use Illuminate\Support\ServiceProvider;

final class CategoriesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        $this->loadViewsFrom(__DIR__.'/Views', 'categories');
        $this->loadMigrationsFrom(__DIR__.'/Migrations');

        $this->app->register(RouteServiceProvider::class);
    }
}
