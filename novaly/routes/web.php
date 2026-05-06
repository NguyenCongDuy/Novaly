<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\StoryController;
use App\Http\Controllers\Admin\ChapterController;

// Route::get('/', function () {
//     return view('home')->name('home');
// });  

// Admin Routes
// Admin Routes 
Route::prefix('admin')
    ->as('admin.')
    ->group(function () {
        // Dashboard route
        Route::view('/', 'admin.dashboard')->name('dashboard');

        // Genres CRUD
        Route::resource('genres', GenreController::class);

        // Authors CRUD
        Route::resource('authors', AuthorController::class);
        
        // Stories CRUD
        Route::resource('stories', StoryController::class);

        // Chapters nested under stories
        Route::resource('stories.chapters', ChapterController::class)
            ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    });
