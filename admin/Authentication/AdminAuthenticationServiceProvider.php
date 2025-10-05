<?php

declare(strict_types=1);

namespace Admin\Authentication;

use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\StatefulGuard;
use Admin\Authentication\SignIn\SignInAdminCommand;
use Admin\Authentication\SignIn\SignInAdminCommandHandler;

final class AdminAuthenticationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        $this->registerCommandHandlers();
        $this->loadViewsFrom(__DIR__.'/Views', 'authentication');
        $this->app->register(RouteServiceProvider::class);
    }

    public function register(): void
    {
        $this->app->bind(StatefulGuard::class, function ($app) {
            return $app->make(SessionGuard::class, ['name' => 'web', 'provider' => $app['auth']->createUserProvider('users'), 'request' => $app->request]);
        });

    }

    protected function registerCommandHandlers(): void
    {
        Bus::map([
            SignInAdminCommand::class => SignInAdminCommandHandler::class,

        ]);
    }
}
