<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'order_id',
        'payment_intent_id',
        'stripe_payment_method_id',
        'amount',
        'currency',
        'status',
        'failure_reason',
        'stripe_response',
        'cardholder_name',
        'billing_address',
        'payment_processed_at'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'stripe_response' => 'array',
        'billing_address' => 'array',
        'payment_processed_at' => 'datetime',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
