<?php

declare(strict_types=1);

use Calexandar\Adminium\Authentication\LogOut\LogOutController;
use Calexandar\Adminium\Authentication\SignIn\SignInAdminController;
use Calexandar\Adminium\Authentication\SignIn\SignInAdminViewController;
use Illuminate\Support\Facades\Route;

Route::post('/sign-in', SignInAdminController::class)
    ->name('admin.sign-in');
Route::get('/sign-in', SignInAdminViewController::class)
    ->name('admin.sign-in.view');

Route::post('/logout', LogOutController::class)->middleware('adminium.auth')
    ->name('admin.logout');
