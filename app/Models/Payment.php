<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'order_id', 'snap_token', 'payment_method', 'payment_type',
        'amount', 'status', 'transaction_id', 'midtrans_response', 'paid_at',
    ];

    protected $casts = [
        'amount' => 'integer',
        'midtrans_response' => 'array',
        'paid_at' => 'datetime',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
