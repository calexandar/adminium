<?php

declare(strict_types=1);

namespace Admin\Authentication;

use Illuminate\Auth\SessionGuard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\ServiceProvider;

final class AdminAuthenticationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        $this->registerCommandHandlers();
        $this->loadMigrationsFrom(__DIR__.'/Migrations');

        $this->app->register(RouteServiceProvider::class);
    }

    public function register(): void
    {
        // $this->app->bind(StatefulGuard::class, function ($app) {
        //     return $app->make(SessionGuard::class, ['name' => 'web', 'provider' => $app['auth']->createUserProvider('users'), 'request' => $app->request]); // @phpstan-ignore-line
        // });

    }

    protected function registerCommandHandlers(): void
    {
        Bus::map([
            SignInAdminCommand::class => SignInAdminCommandHandler::class,

        ]);
    }
}
