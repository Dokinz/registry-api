<?php

use App\Http\Controllers\ItemsController;
use Illuminate\Support\Facades\Route;

Route::resource('items', ItemsController::class)->only(['index', 'show', 'store', 'destroy']);
Route::post('items/invert', [ItemsController::class, 'invert']);
