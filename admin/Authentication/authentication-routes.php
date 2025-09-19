<?php

declare(strict_types=1);

use Admin\Authentication\SignInAdminController;
use Admin\Authentication\SignInAdminViewController;
use Illuminate\Support\Facades\Route;

Route::post('/sign-in', SignInAdminController::class)
    ->name('admin.sign-in');
Route::get('/sign-in', SignInAdminViewController::class)
    ->name('admin.sign-in.view');
