<?php

use App\Http\Controllers\UserConstoller;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ArticleController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name("dashboard");


// Route::controller(UserController::class)->group(function () { BUAT LOGIN REGIS NANTI
//     Route::get('/login', 'showLogin');
//     Route::post('/login', 'login');

//     Route::get('/register', 'showRegister');
//     Route::post('/register', 'register');
// });

Route::resource('User',UserConstoller::class);
Route::resource('Doctor',DoctorController::class);
Route::resource('Service',ServiceController::class);
Route::resource('Category',CategoryController::class);
Route::resource('Transaction',TransactionController::class);
Route::resource('Article',ArticleController::class);