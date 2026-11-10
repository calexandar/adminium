<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Route Prefix
    |--------------------------------------------------------------------------
    |
    | The URL prefix for every Adminium route. Route names remain prefixed
    | with "admin." so they are stable regardless of where they are mounted.
    |
    */

    'route_prefix' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | Super Admin Role
    |--------------------------------------------------------------------------
    |
    | Users with this Spatie role bypass every authorization check through a
    | global "Gate::before" callback registered by the service provider.
    |
    */

    'super_admin_role' => 'super_admin',

    /*
    |--------------------------------------------------------------------------
    | Authenticatable Model
    |--------------------------------------------------------------------------
    |
    | The Eloquent model used for admin authentication. Override this to use
    | your application's own user model.
    |
    */

    'user_model' => Calexandar\Adminium\UserManagment\User::class,

    /*
    |--------------------------------------------------------------------------
    | Branding
    |--------------------------------------------------------------------------
    |
    | Path passed to the "asset()" helper for the panel logo.
    |
    */

    'logo' => 'storage/images/adminium-logo.png',

    /*
    |--------------------------------------------------------------------------
    | Vite Entry Points
    |--------------------------------------------------------------------------
    |
    | The Vite entry points rendered by the panel layout. Point these at your
    | application's compiled assets.
    |
    */

    'vite' => [
        'resources/css/app.css',
        'resources/js/app.js',
        'vendor/calexandar/adminium/resources/css/adminium.css',
        'vendor/calexandar/adminium/resources/js/adminium.js',
    ],

    /*
    |--------------------------------------------------------------------------
    | Enabled Modules
    |--------------------------------------------------------------------------
    |
    | Toggle individual modules on or off. Disabling a module unregisters its
    | routes, views and migrations.
    |
    */

    'modules' => [
        'authentication' => true,
        'dashboard' => true,
        'users' => true,
        'categories' => true,
        'products' => true,
        'articles' => true,
        'groups' => true,
        'news' => true,
        'media' => true,
        'pages' => true,
        'settings' => true,
    ],

];
