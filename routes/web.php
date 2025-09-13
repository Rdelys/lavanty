<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

// Page publique produits
Route::get('/products', function () {
    return view('products'); // ta page statique
})->name('products.public');

Route::get('/product-detail', function () {
    return view('product-detail');
})->name('product.detail');

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
