<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;


class CartItem extends Model
{
     use HasApiTokens, HasFactory, Notifiable, HasRoles;

     protected $fillable = [
    'cart_id',
    'product_id',
    'quantity',
    'price',
    'total',
];

public function cart()
{
    return $this->belongsTo(Cart::class);
}

public function product()
{
    return $this->belongsTo(Product::class);
}
}
