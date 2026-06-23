<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\AuthRepositoryInterface;
use App\Repositories\AuthRepository;
use App\Repositories\CategoryRepository;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Interfaces\WishlistRepositoryInterface;
use App\Repositories\WishlistRepository;
use App\Interfaces\CartRepositoryInterface;
use App\Repositories\CartRepository;
use App\Interfaces\OrderRepositoryInterface;
use App\Repositories\OrderRepository;
use App\Interfaces\PaymentRepositoryInterface;
use App\Repositories\PaymentRepository;
use App\Events\OrderPlaced;
use Illuminate\Support\Facades\Event;
use App\Listeners\SendOrderConfirmationListener;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
        AuthRepositoryInterface::class,
        AuthRepository::class

    );
        $this->app->bind(
    CategoryRepositoryInterface::class,
    CategoryRepository::class
);

$this->app->bind(
    ProductRepositoryInterface::class,
    ProductRepository::class
);

        $this->app->bind(
    WishlistRepositoryInterface::class,
    WishlistRepository::class
);
        $this->app->bind(
    CartRepositoryInterface::class,
    CartRepository::class
);

$this->app->bind(
    OrderRepositoryInterface::class,
    OrderRepository::class
);

$this->app->bind(
    PaymentRepositoryInterface::class,
    PaymentRepository::class
);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
            Event::listen(
        OrderPlaced::class,
        SendOrderConfirmationListener::class
    );
    }
}
