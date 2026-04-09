<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('home')->name('home');
});

// Admin Routes
// Admin Routes (chưa có auth nên để mở)
Route::prefix('admin')
    ->as('admin.')
    ->group(function () {
        // Dashboard route
        Route::view('/', 'admin.dashboard')->name('dashboard');

        // Genres CRUD
        Route::resource('genres', GenreController::class);
    });
