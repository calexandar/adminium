<?php

declare(strict_types=1);

use Admin\Pages\PagesController;
use Illuminate\Support\Facades\Route;

Route::resource('pages', PagesController::class)->except('show');
Route::post('/pages/reorder', [PagesController::class, 'reorder'])->name('pages.reorder');
