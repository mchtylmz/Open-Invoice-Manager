<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['user_id', 'customer_id', 'invoice_number', 'status', 'issue_date', 'due_date', 'subtotal', 'tax_rate', 'tax_amount', 'total', 'currency', 'notes'];

    protected $casts = ['issue_date' => 'date', 'due_date' => 'date', 'subtotal' => 'decimal:2', 'tax_rate' => 'decimal:2', 'tax_amount' => 'decimal:2', 'total' => 'decimal:2'];

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
        return $this->hasMany(InvoiceItem::class);
    }
}
