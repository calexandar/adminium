<?php

declare(strict_types=1);

namespace Admin\Users;

use Illuminate\Support\ServiceProvider;

final class UsersServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        $this->loadViewsFrom(__DIR__.'/Views', 'users');

        $this->app->register(RouteServiceProvider::class);
    }
}
