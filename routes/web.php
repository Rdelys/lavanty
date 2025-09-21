<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [HomeController::class, 'products'])->name('products.public');


// routes/web.php
Route::get('/product/{id}', [HomeController::class, 'productDetail'])->name('product.detail');


// Auth admin
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Routes admin protégées
Route::middleware('auth:admin')->group(function () {
    // Dashboard
    Route::get('/admin', [ProductController::class, 'index'])->name('admin.dashboard');

    // CRUD produits avec prefix
    Route::resource('admin/products', ProductController::class);
    Route::patch('admin/products/{product}/toggle', [ProductController::class, 'toggleMiseEnVente'])
        ->name('admin.products.toggle');
});

use App\Http\Controllers\BidController;

Route::middleware('auth')->group(function() {
    Route::post('/products/{product}/bid', [BidController::class, 'store'])->name('bids.store');
});

Route::get('/products/{product}/bids', [BidController::class, 'index'])->name('bids.index');
