<?php

declare(strict_types=1);

namespace Admin\Products;

use Illuminate\Support\ServiceProvider;

final class ProductsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        $this->loadViewsFrom(__DIR__.'/Views', 'products');
        $this->loadMigrationsFrom(__DIR__.'/Migrations');

        $this->app->register(RouteServiceProvider::class);
    }
}
