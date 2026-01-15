<?php

declare(strict_types=1);

use Admin\Settings\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/settings/{group}', [SettingsController::class, 'index'])->name('settings.index');
Route::post('/settings/{group}', [SettingsController::class, 'store'])->name('settings.store');
