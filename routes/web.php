<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\HTTP\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('index');

// Product
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
