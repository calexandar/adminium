<?php

declare(strict_types=1);

use Admin\Authentication\SignInAdminController;
use Illuminate\Support\Facades\Route;

Route::post('/sign-in', SignInAdminController::class)
    ->name('admin.sign-in');
