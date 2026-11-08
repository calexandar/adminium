<?php

declare(strict_types=1);

use Calexandar\Adminium\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', DashboardController::class)->name('admin.dashboard');
