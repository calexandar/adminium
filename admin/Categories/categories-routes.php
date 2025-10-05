<?php

declare(strict_types=1);

use Admin\Categories\CategoriesController;
use Illuminate\Support\Facades\Route;

Route::resource('categories', CategoriesController::class)->except('show');
