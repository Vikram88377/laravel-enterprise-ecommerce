# Database Design

This document explains the database structure for the Laravel Enterprise Ecommerce project.

## Core Tables

- users
- categories
- products
- product_images
- carts
- cart_items
- wishlists
- addresses
- coupons
- orders
- order_items
- payments
- wallets
- wallet_transactions
- audit_logs

## Relationship Summary

User has many Orders.  
User has one Cart.  
Cart has many Cart Items.  
User has many Wishlists
Product has many Wishlists
Order has many Order Items.  
Product belongs to Category.  
Order has one Payment.  
User has one Wallet.