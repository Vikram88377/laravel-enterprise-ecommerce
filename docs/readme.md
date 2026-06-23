# Laravel Enterprise Ecommerce API

A large-scale Laravel ecommerce backend project built with enterprise architecture and real-world ecommerce flows.

## Tech Stack

- Laravel 12
- PHP 8.2
- MySQL
- Laravel Sanctum
- Spatie Roles & Permissions
- Repository Pattern
- Service Layer
- Form Requests
- API Resources
- Queues & Jobs
- Events & Listeners
- Razorpay Payment Flow

## Modules

- Authentication
- Roles & Permissions
- Categories
- Products
- Product Images
- Wishlist
- Cart
- Coupons
- Orders
- Inventory Management
- Audit Logs
- Admin Order Management
- Payments
- Razorpay Webhooks
- Reports
- Dashboard Summary
- Queues & Email Notifications

## Architecture Flow

Controller
↓
Form Request Validation
↓
Service Layer
↓
Repository Layer
↓
Model / Database
↓
API Resource
↓
JSON Response

## Important Features

- Sanctum token authentication
- Role-based access control
- Product image upload
- Cart calculation
- Coupon discount logic
- Order placement from cart
- Inventory deduction
- Stock rollback on cancellation
- Database transactions
- lockForUpdate race condition handling
- Audit logging
- COD payment
- Razorpay order creation
- Razorpay signature verification
- Razorpay webhook handling
- Queue-based order confirmation email
- Sales reports and dashboard APIs

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve