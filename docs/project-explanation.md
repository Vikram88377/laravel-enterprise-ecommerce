# Laravel Enterprise Ecommerce API - Project Explanation

## Project Overview

Laravel Enterprise Ecommerce API is a scalable ecommerce backend application developed using Laravel 12.

The project follows enterprise architecture using:

- Repository Pattern
- Service Pattern
- Dependency Injection
- Sanctum Authentication
- Spatie Roles & Permissions
- Queues & Jobs
- Events & Listeners
- Database Transactions
- Audit Logs

The goal was to build a production-ready ecommerce system similar to Amazon, Flipkart, or Shopify backend APIs.

---

## Technology Stack

- PHP 8.2
- Laravel 12
- MySQL
- Sanctum
- Spatie Permission
- Queue System
- Razorpay

---

## Modules Implemented

### Authentication

Features:

- Register
- Login
- Logout
- Profile

Authentication is handled using Laravel Sanctum token-based authentication.

---

### Roles & Permissions

Implemented using Spatie package.

Roles:

- Super Admin
- Admin
- Customer

Only admin users can access management and reports APIs.

---

### Category Management

Admin can:

- Create Category
- List Categories

---

### Product Management

Admin can:

- Create Product
- Upload Product Images
- View Product Details

Features:

- SKU support
- Inventory support
- Product image upload

---

### Wishlist Module

Customer can:

- Add Product to Wishlist
- Remove Product from Wishlist
- View Wishlist

---

### Cart Module

Customer can:

- Add Product to Cart
- Update Quantity
- Remove Product
- Clear Cart

Cart automatically recalculates:

- Subtotal
- Discount
- Tax
- Grand Total

---

### Coupon Module

Implemented:

- Percentage Coupons
- Fixed Amount Coupons

Validation includes:

- Start Date
- End Date
- Usage Limit
- Minimum Order Amount

---

### Order Management

Order is created from Cart.

Flow:

Cart
↓
Order
↓
Order Items
↓
Inventory Deduction
↓
Audit Log

Features:

- Order History
- Order Details
- Cancel Order

---

### Inventory Management

Implemented using:

DB Transaction
+
lockForUpdate()

Benefits:

- Prevents overselling
- Handles concurrent orders

---

### Audit Logs

Tracks all important actions.

Examples:

- Order Placed
- Order Cancelled
- Payment Verified
- Status Updated

---

### Payment Module

Supported:

- Cash On Delivery
- Razorpay Integration

Implemented:

- Payment Creation
- Payment Verification
- Webhook Handling

---

### Queue System

Implemented:

- Jobs
- Events
- Listeners

Flow:

OrderPlaced Event
↓
Listener
↓
Email Job
↓
Queue Worker

This keeps APIs fast and asynchronous.

---

### Reports Module

Implemented:

- Sales Report
- Orders Report
- Customers Report
- Top Products Report
- Monthly Sales Report

Supports date range filters.

---

### Dashboard APIs

Provides:

- Total Orders
- Total Revenue
- Total Customers
- Recent Orders
- Top Products

---

## Database Design

Main Tables:

- users
- categories
- products
- product_images
- wishlists
- carts
- cart_items
- coupons
- orders
- order_items
- payments
- audit_logs
- jobs
- failed_jobs

---

## Key Laravel Concepts Used

- Service Container
- Dependency Injection
- Repository Pattern
- Service Pattern
- API Resources
- Form Requests
- Middleware
- Sanctum
- Spatie Roles
- Events
- Listeners
- Jobs
- Queues
- DB Transactions
- lockForUpdate()

---

## Conclusion

This project demonstrates enterprise-level Laravel API development practices including clean architecture, security, scalability, asynchronous processing, payment integration, reporting, and inventory management.