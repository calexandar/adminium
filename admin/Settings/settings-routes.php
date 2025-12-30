<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Admin\Settings\SettingsController;

Route::get('/settings/{group}', [SettingsController::class, 'index'])->name('settings.index');
Route::post('/settings/{group}', [SettingsController::class, 'store'])->name('settings.store');
