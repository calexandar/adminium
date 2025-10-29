<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Admin\Products\ProductsController;

Route::resource('products', ProductsController::class)->except('show');
Route::post('/products/reorder', [ProductsController::class, 'reorder'])->name('products.reorder');
