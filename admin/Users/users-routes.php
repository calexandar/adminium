<?php

declare(strict_types=1);

use Admin\Users\UsersController;
use Illuminate\Support\Facades\Route;

Route::name('admin.')->group(function () {

    Route::resource('users', UsersController::class)->except('show');
});
