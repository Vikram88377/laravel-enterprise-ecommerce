<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CartController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\WishlistController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\PaymentController;
use App\Http\Controllers\Api\V1\ReportController;
Route::prefix('v1')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {

        Route::get('/profile', [AuthController::class, 'profile']);
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::get('/categories', [CategoryController::class, 'index']);
        Route::post('/categories', [CategoryController::class, 'store']);

        Route::apiResource('products', ProductController::class)
            ->only(['index', 'store', 'show']);

        Route::post('/products/{id}/images', [ProductController::class, 'uploadImages']);

        Route::get('/wishlist', [WishlistController::class, 'index']);
        Route::post('/wishlist', [WishlistController::class, 'store']);
        Route::delete('/wishlist/{productId}', [WishlistController::class, 'destroy']);

        Route::get('/cart', [CartController::class, 'index']);
        Route::post('/cart', [CartController::class, 'store']);
        Route::put('/cart/{productId}', [CartController::class, 'update']);
        Route::delete('/cart/{productId}', [CartController::class, 'destroy']);
        Route::delete('/cart', [CartController::class, 'clear']);

        Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon']);
        Route::delete('/cart/remove-coupon', [CartController::class, 'removeCoupon']);

        Route::post('/orders', [OrderController::class, 'store']);
        Route::get('/orders', [OrderController::class, 'index']);
        Route::get('/orders/{id}', [OrderController::class, 'show']);

        Route::post('/orders/{id}/cancel',[OrderController::class, 'cancel']);
        Route::post('/orders/{orderId}/pay/cod', [PaymentController::class, 'cod']);
        Route::post('/orders/{orderId}/pay/razorpay', [PaymentController::class, 'razorpay']);
        Route::post('/payments/razorpay/verify', [PaymentController::class, 'verifyRazorpay']);
        Route::post('/razorpay/webhook', [PaymentController::class, 'razorpayWebhook']);

        Route::middleware('role:super_admin|admin')->group(function () {

    Route::get('/admin/orders', [OrderController::class, 'adminOrders']);

    Route::patch('/admin/orders/{id}/status', [OrderController::class, 'updateStatus']);

        Route::get('/reports/sales', [ReportController::class, 'salesReport']);
    Route::get('/reports/orders', [ReportController::class, 'ordersReport']);
    Route::get('/reports/top-products', [ReportController::class, 'topProducts']);
    Route::get('/reports/customers', [ReportController::class, 'customersReport']);

    Route::get('/reports/monthly-sales',[ReportController::class, 'monthlySales']);
});

Route::get('/reports/dashboard-summary',[ReportController::class, 'dashboardSummary']);


    });
});