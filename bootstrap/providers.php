<?php

declare(strict_types=1);

return [
    App\Providers\AppServiceProvider::class,
    Admin\Authentication\AdminAuthenticationServiceProvider::class,
    Admin\Dashboard\DashboardServiceProvider::class,
    Admin\Users\UsersServiceProvider::class,
    Admin\Categories\CategoriesServiceProvider::class,
    Admin\Products\ProductsServiceProvider::class,
];
