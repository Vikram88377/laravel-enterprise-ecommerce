# Project Architecture

## Overview

This project follows a clean enterprise-style Laravel architecture using Controller, Request, Service, Repository, Resource, and Model layers.

## Request Flow

```text
Client / Postman / Frontend
        ↓
API Route
        ↓
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

Layer Responsibilities
Controller

Handles request and response only.

Example:

AuthController
ProductController
CartController
OrderController
PaymentController
Form Request

Handles validation.

Example:

RegisterRequest
StoreProductRequest
AddToCartRequest
ApplyCouponRequest
Service Layer

Handles business logic.

Example:

OrderService
CartService
PaymentService
ReportService
Repository Layer

Handles database queries.

Example:

OrderRepository
ProductRepository
CartRepository
PaymentRepository
API Resource

Formats API response.

Example:

UserResource
ProductResource
CartResource
OrderResource
PaymentResource
Enterprise Concepts Used
Repository Pattern
Service Pattern
Dependency Injection
Laravel Service Container
Sanctum Authentication
Spatie Role Permission
DB Transactions
lockForUpdate()
Queues and Jobs
Events and Listeners
Audit Logs
Payment Webhooks
Reports and Dashboard APIs
Order Flow
User adds product to cart
        ↓
Cart total is calculated
        ↓
Coupon is applied
        ↓
Order is placed
        ↓
Stock is deducted
        ↓
Audit log is created
        ↓
OrderPlaced event is fired
        ↓
Email job is queued
Payment Flow
Order Created
        ↓
Payment Initiated
        ↓
COD / Razorpay Selected
        ↓
Payment Record Created
        ↓
Payment Verified
        ↓
Order Payment Status Updated
        ↓
Audit Log Created
Queue Flow
OrderPlaced Event
        ↓
SendOrderConfirmationListener
        ↓
SendOrderConfirmationEmailJob
        ↓
jobs table
        ↓
queue:work
        ↓
Email Sent