<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\HTTP\Controllers\AuthController;
use App\Http\Controllers\AdminController;
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
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::prefix('dashboard')->middleware('authentication')->group(function () {

    //Admin
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/index', [AdminController::class, 'index'])->name('dashboard.admin.index');
        Route::get('/add', [AdminController::class, 'addProduct'])->name('dashboard.admin.add');
        Route::post('/store', [AdminController::class, 'storeProduct'])->name('dashboard.admin.store');
        Route::get('/edit/{id}', [AdminController::class, 'editProduct'])->name('dashboard.admin.edit');
        Route::put('/update/{id}', [AdminController::class, 'updateProduct'])->name('dashboard.admin.update');
        Route::post('/delete/{id}', [AdminController::class, 'deleteProduct'])->name('dashboard.admin.delete');
    });

    //Users
    // Route::prefix('users')->middleware('role:superadmin')->group(function () {
    //     Route::get('/', [DashboardController::class, 'users'])->name('dashboard.users');
    //     Route::get('/add', [DashboardController::class, 'addUser'])->name('dashboard.users.add');
    //     Route::post('/store', [DashboardController::class, 'storeUser'])->name('dashboard.users.store');
    //     Route::get('/edit/{id}', [DashboardController::class, 'editUser'])->name('dashboard.users.edit');
    //     Route::put('/update/{id}', [DashboardController::class, 'updateUser'])->name('dashboard.users.update');
    //     Route::post('/delete/{id}', [DashboardController::class, 'deleteUser'])->name('dashboard.users.delete');
    // });
});
