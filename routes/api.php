<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Bid;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/latest-bid', function() {
    $bid = Bid::with('product')->latest('created_at')->first();
    if (!$bid) return response()->json(['amount'=>0]);
    return response()->json([
        'amount' => $bid->amount,
        'product' => $bid->product->title,
    ]);
});