<?php

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

Route::get('/', function () {
    return view('welcome');
});


//admin routes
use App\Http\Controllers\AdminAuthController;

// Page de connexion admin
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

// Page dashboard protégée par auth:admin
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

use Illuminate\Support\Facades\Auth;

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Product management routes
use App\Http\Controllers\ProductController;

Route::middleware('auth:admin')->group(function () {
    // Dashboard = liste des produits
    Route::get('/admin', [ProductController::class, 'index'])->name('admin.dashboard');

    // CRUD produits
    Route::resource('products', ProductController::class);
});
