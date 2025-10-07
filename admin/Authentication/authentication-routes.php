<?php

declare(strict_types=1);

use Admin\Authentication\LogOut\LogOutController;
use Admin\Authentication\SignIn\SignInAdminController;
use Admin\Authentication\SignIn\SignInAdminViewController;
use Illuminate\Support\Facades\Route;

Route::post('/sign-in', SignInAdminController::class)
    ->name('admin.sign-in');
Route::get('/sign-in', SignInAdminViewController::class)
    ->name('admin.sign-in.view');

Route::post('/logout', LogOutController::class)->middleware('auth')
    ->name('admin.logout');
