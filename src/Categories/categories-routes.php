<?php

declare(strict_types=1);

use Calexandar\Adminium\Categories\CategoriesController;
use Illuminate\Support\Facades\Route;

Route::resource('categories', CategoriesController::class)->except('show');
Route::post('/categories/reorder', [CategoriesController::class, 'reorder'])->name('categories.reorder');
