<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutoBidController;
use App\Http\Controllers\ProfileController;



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


Route::middleware('auth')->group(function() {
    Route::post('/products/{product}/auto-bid', [AutoBidController::class, 'store'])->name('auto-bids.store');
});
Route::get('/admin/bids/filter', [\App\Http\Controllers\BidController::class, 'filter'])->name('admin.bids.filter');

Route::middleware(['auth'])->group(function () {
    Route::get('/profil', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/api/auction-summary', function () {
    $user = auth()->user();
    if (!$user) {
        return response()->json(['leading' => 0, 'lost' => 0]);
    }

    $userProducts = \App\Models\Bid::where('user_id', $user->id)
        ->pluck('product_id')
        ->unique();

    $leading = 0;
    $lost = 0;

    foreach ($userProducts as $productId) {
        $highest = \App\Models\Bid::where('product_id', $productId)
            ->orderByDesc('amount')
            ->first();

        if ($highest && $highest->user_id === $user->id) {
            $leading++;
        } else {
            $lost++;
        }
    }

    return response()->json([
        'leading' => $leading,
        'lost' => $lost,
    ]);
});

Route::get('/blog', function () {
    return view('blog');
})->name('blog');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/products', [ProductController::class, 'shop'])->name('products.shop');
Route::get('/test-time', function () {
    return [
        'php_tz' => date_default_timezone_get(),
        'laravel_now' => now()->toDateTimeString(),
        'mysql_now' => DB::select("SELECT NOW() as now")[0]->now,
    ];
});
Route::get('/products/{product}/end-time', function(App\Models\Product $product) {
    return response()->json([
        'end_time' => $product->end_time->format('Y-m-d\TH:i:s')
    ]);
});
