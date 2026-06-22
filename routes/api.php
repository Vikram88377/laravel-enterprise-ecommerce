<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CategoryController;


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


    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);


        });
});