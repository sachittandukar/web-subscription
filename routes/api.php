<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('subscriber')->name('subscriber.')->group(function () {
    Route::post('/add', [SubscriberController::class, 'store'])->name('store');
});

Route::prefix('post')->name('post.')->group(function () {
    Route::post('/add', [PostController::class, 'store'])->name('store');
});
