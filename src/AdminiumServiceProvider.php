<?php

declare(strict_types=1);

namespace Calexandar\Adminium;

use Calexandar\Adminium\Articles\ArticlesServiceProvider;
use Calexandar\Adminium\Authentication\AdminAuthenticationServiceProvider;
use Calexandar\Adminium\Categories\CategoriesServiceProvider;
use Calexandar\Adminium\Dashboard\DashboardServiceProvider;
use Calexandar\Adminium\Groups\GroupsServiceProvider;
use Calexandar\Adminium\Media\MediaServiceProvider;
use Calexandar\Adminium\News\NewsServiceProvider;
use Calexandar\Adminium\Pages\PagesServiceProvider;
use Calexandar\Adminium\Products\ProductsServiceProvider;
use Calexandar\Adminium\Settings\SettingsServiceProvider;
use Calexandar\Adminium\Users\UsersServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

final class AdminiumServiceProvider extends ServiceProvider
{
    /**
     * @var array<string, class-string<ServiceProvider>>
     */
    private const MODULES = [
        'authentication' => AdminAuthenticationServiceProvider::class,
        'dashboard' => DashboardServiceProvider::class,
        'users' => UsersServiceProvider::class,
        'categories' => CategoriesServiceProvider::class,
        'products' => ProductsServiceProvider::class,
        'articles' => ArticlesServiceProvider::class,
        'groups' => GroupsServiceProvider::class,
        'news' => NewsServiceProvider::class,
        'media' => MediaServiceProvider::class,
        'pages' => PagesServiceProvider::class,
        'settings' => SettingsServiceProvider::class,
    ];

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/adminium.php', 'adminium');

        foreach (self::MODULES as $module => $provider) {
            if ((bool) config('adminium.modules.'.$module, true)) {
                $this->app->register($provider);
            }
        }
    }

    public function boot(): void
    {
        $this->registerSuperAdminGate();

        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../config/adminium.php' => config_path('adminium.php'),
        ], 'adminium-config');

        $this->publishes([
            __DIR__.'/../resources/css' => resource_path('css/vendor/adminium'),
            __DIR__.'/../resources/js' => resource_path('js/vendor/adminium'),
        ], 'adminium-assets');
    }

    private function registerSuperAdminGate(): void
    {
        $role = config('adminium.super_admin_role');

        if (! is_string($role) || $role === '') {
            return;
        }

        Gate::before(function (object $user) use ($role): ?bool {
            if (! method_exists($user, 'hasRole')) {
                return null;
            }

            return $user->hasRole($role) ? true : null;
        });
    }
}
