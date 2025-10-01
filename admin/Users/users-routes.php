<?php

declare(strict_types=1);

use Admin\Users\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('users', [UsersController::class, 'index'])->name('admin.users.index');
Route::get('users/create', [UsersController::class, 'create'])->name('admin.users.create');
Route::post('users/store', [UsersController::class, 'store'])->name('admin.users.store');
Route::get('users/{user}/edit', [UsersController::class, 'edit'])->name('admin.users.edit');
Route::put('users/{user}/update', [UsersController::class, 'update'])->name('admin.users.update');
Route::delete('users/{user}/delete', [UsersController::class, 'destroy'])->name('admin.users.delete');
