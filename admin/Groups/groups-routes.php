<?php

declare(strict_types=1);

use Admin\Groups\GroupsController;
use Illuminate\Support\Facades\Route;

Route::resource('groups', GroupsController::class)->except('show');
Route::post('/groups/reorder', [GroupsController::class, 'reorder'])->name('groups.reorder');
