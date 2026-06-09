<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = ['user_id', 'customer_id', 'quote_number', 'status', 'issue_date', 'valid_until', 'subtotal', 'tax_rate', 'tax_amount', 'total', 'currency', 'notes'];

    protected $casts = ['issue_date' => 'date', 'valid_until' => 'date', 'subtotal' => 'decimal:2', 'tax_rate' => 'decimal:2', 'tax_amount' => 'decimal:2', 'total' => 'decimal:2'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(QuoteItem::class);
    }
}
