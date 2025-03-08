<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Added fillable properties for order details
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'postal_code',
        'city',
        'country',
        'order_items',
        'total'
    ];

    protected $casts = [
        'order_items' => 'array',
        'total' => 'float',
    ];
}
