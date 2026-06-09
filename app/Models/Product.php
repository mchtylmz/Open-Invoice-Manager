<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['user_id', 'name', 'description', 'unit_price', 'unit_type', 'currency'];

    protected $casts = ['unit_price' => 'decimal:2'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function quoteItems()
    {
        return $this->hasMany(QuoteItem::class);
    }
}
