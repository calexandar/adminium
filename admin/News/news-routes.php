<?php

declare(strict_types=1);

use Admin\News\NewsController;
use Illuminate\Support\Facades\Route;

Route::resource('news', NewsController::class)->except('show');
Route::post('/news/reorder', [NewsController::class, 'reorder'])->name('news.reorder');
