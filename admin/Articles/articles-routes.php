<?php

declare(strict_types=1);

use Admin\Articles\ArticlesController;
use Illuminate\Support\Facades\Route;

Route::resource('articles', ArticlesController::class)->except('show');
Route::post('/articles/reorder', [ArticlesController::class, 'reorder'])->name('articles.reorder');
