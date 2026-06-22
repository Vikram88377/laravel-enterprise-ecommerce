# Git Workflow

## Repository

```bash
git clone <repository-url>
```

## Branch Strategy

### Main Branch

```text
main
```

Production-ready stable code.

### Feature Branches

```text
feature/authentication
feature-cart-wishlist-module
feature-coupon-order-module
feature-payment-module
feature-queue-notification-module
```

Each feature is developed in an isolated branch.

---

# Daily Development Workflow

## Pull Latest Changes

```bash
git checkout main

git pull origin main
```

## Create Feature Branch

```bash
git checkout -b feature/module-name
```

Example:

```bash
git checkout -b feature-payment-module
```

---

# Working Process

## Check Changes

```bash
git status
```

## Add Files

```bash
git add .
```

## Commit Changes

```bash
git commit -m "feat: implement payment module"
```

---

# Push Branch

First Time:

```bash
git push -u origin feature-payment-module
```

After First Push:

```bash
git push
```

---

# Branch Switching

```bash
git checkout feature-authentication

git checkout feature-payment-module
```

---

# View Branches

Local:

```bash
git branch
```

Remote:

```bash
git branch -r
```

All:

```bash
git branch -a
```

---

# Merge Workflow

Switch to Main:

```bash
git checkout main
```

Merge Branch:

```bash
git merge feature-payment-module
```

Push:

```bash
git push origin main
```

---

# Useful Commands

## View Commit History

```bash
git log --oneline
```

## View Differences

```bash
git diff
```

## View Current Branch

```bash
git branch
```

---

# Undo Operations

## Restore File

```bash
git restore filename
```

## Remove Staged Changes

```bash
git reset HEAD filename
```

## Reset Last Commit

```bash
git reset --soft HEAD~1
```

---

# Project Branch History

## Day 1 - Day 3

```text
feature/authentication
```

Modules:

* Authentication
* Roles & Permissions

## Day 4 - Day 6

```text
feature-cart-wishlist-module
```

Modules:

* Categories
* Products
* Wishlist
* Cart

## Day 7 - Day 8

```text
feature-coupon-order-module
```

Modules:

* Coupons
* Orders
* Inventory
* Audit Logs
* Admin Management

## Day 9

```text
feature-payment-module
```

Modules:

* COD Payment
* Razorpay Integration
* Payment Verification
* Webhooks

---

# Git Commit Convention

## Feature

```bash
git commit -m "feat: add coupon module"
```

## Fix

```bash
git commit -m "fix: resolve cart calculation bug"
```

## Refactor

```bash
git commit -m "refactor: optimize order service"
```

## Documentation

```bash
git commit -m "docs: update api documentation"
```

---

# Project Architecture

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
```

Git workflow follows feature-based development with isolated branches and modular commits.
