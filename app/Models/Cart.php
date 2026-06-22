<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
class Cart extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    protected $fillable = [
    'user_id',
    'subtotal',
    'discount',
    'tax',
    'shipping_charge',
    'grand_total',
    'status',
];



            public function user()
{
    return $this->belongsTo(User::class);
}

public function items()
{
    return $this->hasMany(CartItem::class);
}


}
