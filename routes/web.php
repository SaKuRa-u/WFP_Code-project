<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserConstoller;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ArticleController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// 1. GUEST ACCESS (Landing Page Utama)
Route::get('/', function () {
    return view('welcome');
});

// 2. DASHBOARD (Bawaan Breeze)
Route::get('/dashboard', function () {
    /** @var \App\Models\User|null $user */
    $user = Auth::user();

    if ($user && $user->isDoctor()) {
        return redirect('/service');
    }
    
    return redirect('/transaction');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. AUTHENTICATED ACCESS (Harus Login)
Route::middleware('auth')->group(function () {
    
    // --- Route Profil & Manajemen Pengguna ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('user', UserConstoller::class);
    
    // --- Route Transaksi (Bisa diakses Dokter & Non-Dokter) ---
    Route::resource('transaction', TransactionController::class);
    Route::post(
        "/transaction/detail",
        [TransactionController::class, 'showDetail']
    )->name("transaction.showDetailTransaction");


    // ==========================================
    // KELOMPOK ROUTE KHUSUS USER DOKTER
    // ==========================================
    Route::middleware(['role:doctor'])->group(function () {
        Route::resource('doctor', DoctorController::class);
        Route::resource('service', ServiceController::class);
        Route::resource('category', CategoryController::class);

        // AJAX Kategori dimasukkan ke sini agar hanya bisa diakses Dokter/Staff Medis
        Route::post(
            "/category/showinfo",
            [CategoryController::class, 'showinfo']
        )->name("category.showinfo");

        Route::post(
            "/category/showListServices",
            [CategoryController::class, 'showListServices']
        )->name("category.showListServices");
    });


    // ==========================================
    // KELOMPOK ROUTE KHUSUS USER NON-DOKTER
    // ==========================================
    Route::middleware(['role:non-doctor'])->group(function () {
        Route::resource('article', ArticleController::class);
    });

});

require __DIR__ . '/auth.php';