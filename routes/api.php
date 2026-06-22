<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\WishlistController;
use App\Http\Controllers\Api\V1\CartController;

Route::prefix('v1')->group(function () {

    // Public Routes
    Route::post(
        '/register',
        [AuthController::class, 'register']
    );

    Route::post(
        '/login',
        [AuthController::class, 'login']
    );

    // Protected Routes
    Route::middleware('auth:sanctum')
        ->group(function () {

            Route::get(
                '/profile',
                [AuthController::class, 'profile']
            );

            Route::post(
                '/logout',
                [AuthController::class, 'logout']
            );

        Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart', [CartController::class, 'store']);
  Route::put('/cart/{productId}', [CartController::class, 'update']);

Route::delete('/cart/{productId}', [CartController::class, 'destroy']);

Route::delete('/cart', [CartController::class, 'clear']);

Route::get('/wishlist',[WishlistController::class, 'index']);

Route::post('/wishlist',[WishlistController::class, 'store']);

Route::delete('/wishlist/{productId}',[WishlistController::class, 'destroy']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);


    Route::apiResource('products',ProductController::class)->only(['index','store','show']);

        });

        Route::post('/products/{id}/images',[ProductController::class, 'uploadImages']
);


});