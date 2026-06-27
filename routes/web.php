<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ServiceController;

// Public
// Route::get('/', [ArticleController::class, 'landing'])->name('landing');
Route::get('/', function () {
    return view('welcome');
});

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

// Auth routes
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile (bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['role:admin,doctor'])->group(function () {

        Route::resource('articles', ArticleController::class)
            ->except([
                'index',
                'show',
            ]);
    });

    // Transactions (semua role, dikontrol Policy)
    Route::resource('transactions', TransactionController::class);

    // Messages (chat konsultasi)
    Route::resource('transactions.messages', MessageController::class)
        ->only(['index', 'store']);

    // Admin only
    Route::middleware(['role:admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::resource('users', UserController::class);
            Route::patch('users/{id}/restore', [UserController::class, 'restore'])
                ->name('users.restore');
            Route::delete('users/{id}/force-delete', [UserController::class, 'forceDelete'])
                ->name('users.forceDelete');

            Route::resource('doctors', DoctorController::class);
            Route::patch('doctors/{id}/restore', [DoctorController::class, 'restore'])
                ->name('doctors.restore');
            Route::delete('doctors/{id}/force-delete', [DoctorController::class, 'forceDelete'])
                ->name('doctors.forceDelete');


            Route::resource('categories', CategoryController::class);
            Route::patch('categories/{id}/restore', [CategoryController::class, 'restore'])
                ->name('categories.restore');
            Route::delete('categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])
                ->name('categories.forceDelete');

            Route::resource('services', ServiceController::class);
            Route::patch('services/{id}/restore', [ServiceController::class, 'restore'])
                ->name('services.restore');
            Route::delete('services/{id}/force-delete', [ServiceController::class, 'forceDelete'])
                ->name('services.forceDelete');
        });
});

require __DIR__ . '/auth.php';
