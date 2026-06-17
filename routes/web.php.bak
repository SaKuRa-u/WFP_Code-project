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

Route::resource('user',UserConstoller::class);
Route::resource('doctor',DoctorController::class);
Route::resource('service',ServiceController::class);
Route::resource('category',CategoryController::class);
Route::resource('transaction',TransactionController::class);
Route::resource('article',ArticleController::class);

Route::post(
    "/category/showinfo",
    [CategoryController::class, 'showinfo']
)->name("category.showinfo");

Route::post(
    "/category/showListServices",
    [CategoryController::class, 'showListServices']
)->name("category.showListServices");

Route::post(
    "/transaction/detail",
    [TransactionController::class, 'showDetail']
)->name("transaction.showDetailTransaction");