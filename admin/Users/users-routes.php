<?php

declare(strict_types=1);

use Admin\Users\UsersController;
use Illuminate\Support\Facades\Route;

Route::resource('users', UsersController::class)->except('show');
