<?php

declare(strict_types=1);

use Admin\Media\MediaController;
use Illuminate\Support\Facades\Route;

Route::resource('media', MediaController::class)->except('show');
Route::post('/media/reorder', [MediaController::class, 'reorder'])->name('media.reorder');
