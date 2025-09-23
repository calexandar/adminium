<?php

declare(strict_types=1);

use Admin\Users\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('users', [UsersController::class, 'index'])->name('admin.users.index');
Route::get('users/{user}/edit', [UsersController::class, 'edit'])->name('admin.users.edit');
// Route::delete('users/{user}/delete', UsersDeleteController::class)->name('admin.users.delete');
