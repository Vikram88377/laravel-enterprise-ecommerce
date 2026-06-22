# Laravel Enterprise Ecommerce API Documentation

## Base URL

```text
http://127.0.0.1:8000/api/v1
```

## Authentication

### Register

```http
POST /register
```

Request:

```json
{
    "name": "Vikram Kumar",
    "email": "vikram@example.com",
    "phone": "9876543210",
    "password": "password123",
    "password_confirmation": "password123"
}
```

### Login

```http
POST /login
```

Request:

```json
{
    "email": "vikram@example.com",
    "password": "password123"
}
```

### Profile

```http
GET /profile
```

Headers:

```text
Authorization: Bearer TOKEN
```

### Logout

```http
POST /logout
```

---

# Category APIs

### Get Categories

```http
GET /categories
```

### Create Category

```http
POST /categories
```

```json
{
    "name": "Electronics",
    "description": "Electronic products"
}
```

---

# Product APIs

### Get Products

```http
GET /products
```

### Get Product Details

```http
GET /products/{id}
```

### Create Product

```http
POST /products
```

```json
{
    "category_id": 1,
    "name": "iPhone 16 Pro",
    "sku": "IPH16PRO",
    "price": 120000,
    "sale_price": 115000,
    "stock": 50,
    "description": "Apple flagship smartphone"
}
```

### Upload Product Images

```http
POST /products/{id}/images
```

Form Data:

```text
images[]
```

---

# Wishlist APIs

### Get Wishlist

```http
GET /wishlist
```

### Add To Wishlist

```http
POST /wishlist
```

```json
{
    "product_id": 1
}
```

### Remove Wishlist Item

```http
DELETE /wishlist/{productId}
```

---

# Cart APIs

### Get Cart

```http
GET /cart
```

### Add To Cart

```http
POST /cart
```

```json
{
    "product_id": 1,
    "quantity": 2
}
```

### Update Cart Quantity

```http
PUT /cart/{productId}
```

```json
{
    "quantity": 5
}
```

### Remove Cart Item

```http
DELETE /cart/{productId}
```

### Clear Cart

```http
DELETE /cart
```

---

# Coupon APIs

### Apply Coupon

```http
POST /cart/apply-coupon
```

```json
{
    "code": "SAVE10"
}
```

### Remove Coupon

```http
DELETE /cart/remove-coupon
```

---

# Order APIs

### Place Order

```http
POST /orders
```

Body:

```json
{}
```

### Get Orders

```http
GET /orders
```

### Get Order Details

```http
GET /orders/{id}
```

### Cancel Order

```http
POST /orders/{id}/cancel
```

---

# Admin Order APIs

### Get All Orders

```http
GET /admin/orders
```

### Update Order Status

```http
PATCH /admin/orders/{id}/status
```

```json
{
    "status": "confirmed"
}
```

Available Status:

```text
pending
confirmed
processing
shipped
delivered
cancelled
```

---

# Payment APIs

### COD Payment

```http
POST /orders/{id}/pay/cod
```

### Razorpay Order Create

```http
POST /orders/{id}/pay/razorpay
```

### Razorpay Verify Payment

```http
POST /payments/razorpay/verify
```

```json
{
    "razorpay_order_id": "order_xxxxx",
    "razorpay_payment_id": "pay_xxxxx",
    "razorpay_signature": "signature_xxxxx"
}
```

### Razorpay Webhook

```http
POST /razorpay/webhook
```

---

# Security

* Laravel Sanctum Authentication
* Spatie Roles & Permissions
* Request Validation
* Repository Pattern
* Service Pattern
* Audit Logging
* DB Transactions
* lockForUpdate()
* Payment Verification

---

# Architecture

```text
Controller
    ↓
Request Validation
    ↓
Service Layer
    ↓
Repository Layer
    ↓
Database
    ↓
Resource
    ↓
JSON Response
```
