<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Admin\Categories\CategoriesController;

Route::resource('categories', CategoriesController::class)->except('show');

