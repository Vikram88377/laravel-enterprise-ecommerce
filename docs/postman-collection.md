# Postman Testing Guide

## Authentication

### Register

POST /api/v1/register

### Login

POST /api/v1/login

### Profile

GET /api/v1/profile

### Logout

POST /api/v1/logout

---

## Categories

### Create Category

POST /api/v1/categories

### List Categories

GET /api/v1/categories

---

## Products

### Create Product

POST /api/v1/products

### Product List

GET /api/v1/products

### Product Details

GET /api/v1/products/{id}

### Upload Images

POST /api/v1/products/{id}/images

---

## Wishlist

### Add Product

POST /api/v1/wishlist

### List Wishlist

GET /api/v1/wishlist

### Remove Product

DELETE /api/v1/wishlist/{productId}

---

## Cart

### Add Product

POST /api/v1/cart

### View Cart

GET /api/v1/cart

### Update Quantity

PUT /api/v1/cart/{productId}

### Remove Item

DELETE /api/v1/cart/{productId}

### Clear Cart

DELETE /api/v1/cart

---

## Coupons

### Apply Coupon

POST /api/v1/cart/apply-coupon

### Remove Coupon

DELETE /api/v1/cart/remove-coupon

---

## Orders

### Place Order

POST /api/v1/orders

### Order History

GET /api/v1/orders

### Order Details

GET /api/v1/orders/{id}

### Cancel Order

POST /api/v1/orders/{id}/cancel

---

## Payments

### COD Payment

POST /api/v1/payments/cod

### Razorpay Create Order

POST /api/v1/payments/razorpay/order

### Razorpay Verify

POST /api/v1/payments/razorpay/verify

### Webhook

POST /api/v1/payments/webhook

---

## Reports

### Sales Report

GET /api/v1/reports/sales

### Orders Report

GET /api/v1/reports/orders

### Top Products

GET /api/v1/reports/top-products

### Customers Report

GET /api/v1/reports/customers

### Monthly Sales

GET /api/v1/reports/monthly-sales

### Dashboard Summary

GET /api/v1/reports/dashboard-summary