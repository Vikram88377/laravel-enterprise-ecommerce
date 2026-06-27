<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfilesController;

Route::middleware([
    'auth',
    'role:super_admin|admin'
])->prefix('admin')
->name('admin.')
->group(function () {

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');

});
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth','role:super_admin|admin'])->prefix('admin')->name('admin.')->group(function () {
Route::get('/dashboard',[DashboardController::class, 'index'] )->name('dashboard');
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::delete('/product-images/{image}',[ProductController::class, 'destroyImage'])->name('product-images.destroy');

Route::resource('coupons', CouponController::class);

Route::get('/orders', [OrderController::class, 'index'])
    ->name('orders.index');

Route::get('/orders/{order}', [OrderController::class, 'show'])
    ->name('orders.show');

Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])
    ->name('orders.update-status');

Route::get('/payments', [PaymentController::class, 'index'])
    ->name('payments.index');

        Route::get('/audit-logs', [AuditLogController::class, 'index'])
    ->name('audit-logs.index');

    Route::get('/reports', [ReportController::class, 'index'])
    ->name('reports.index');

        Route::resource('users', UserController::class);
            Route::resource('roles', RoleController::class);
            Route::resource('permissions', PermissionController::class);
            Route::get(
    '/roles/{role}/permissions',
    [RoleController::class, 'permissions']
)->name('roles.permissions');

Route::post(
    '/roles/{role}/permissions',
    [RoleController::class, 'syncPermissions']
)->name('roles.permissions.sync');

        Route::resource('users', UserController::class)
    ->middleware('permission:view-users');

Route::resource('products', ProductController::class)
    ->middleware('permission:view-products');

Route::get('/reports', [ReportController::class, 'index'])
    ->name('reports.index')
    ->middleware('permission:view-reports');



    Route::get('/profile', [ProfilesController::class, 'edit'])
    ->name('profile.edit');

Route::put('/profile', [ProfilesController::class, 'update'])
    ->name('profile.update');

Route::put('/profile/password', [ProfilesController::class, 'updatePassword'])
    ->name('profile.password');
});





require __DIR__.'/auth.php';
