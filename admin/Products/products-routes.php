<?php

declare(strict_types=1);

use Admin\Products\ProductsController;
use Illuminate\Support\Facades\Route;

Route::resource('products', ProductsController::class)->except('show');
Route::post('/products/reorder', [ProductsController::class, 'reorder'])->name('products.reorder');
