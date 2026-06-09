<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    public function run(int $userId): void
    {
        $customer = Customer::where('user_id', $userId)->first();
        if (!$customer) return;

        $product = Product::where('user_id', $userId)->first();
        if (!$product) return;

        $invoice = Invoice::create([
            'user_id' => $userId,
            'customer_id' => $customer->id,
            'invoice_number' => 'INV-202606-0001',
            'status' => 'paid',
            'issue_date' => now()->subDays(10),
            'due_date' => now()->subDays(3),
            'subtotal' => 15000,
            'tax_rate' => 20,
            'tax_amount' => 3000,
            'total' => 18000,
            'currency' => 'TRY',
            'notes' => 'Web tasarım hizmeti faturası',
        ]);

        InvoiceItem::create([
            'invoice_id' => $invoice->id,
            'product_id' => $product->id,
            'description' => $product->name,
            'quantity' => 1,
            'unit_price' => $product->unit_price,
            'total' => $product->unit_price,
        ]);

        $invoice2 = Invoice::create([
            'user_id' => $userId,
            'customer_id' => $customer->id,
            'invoice_number' => 'INV-202606-0002',
            'status' => 'pending',
            'issue_date' => now()->subDays(5),
            'due_date' => now()->addDays(25),
            'subtotal' => 7500,
            'tax_rate' => 20,
            'tax_amount' => 1500,
            'total' => 9000,
            'currency' => 'TRY',
            'notes' => 'SEO danışmanlık hizmeti',
        ]);

        InvoiceItem::create([
            'invoice_id' => $invoice2->id,
            'product_id' => null,
            'description' => 'SEO Danışmanlık (2 ay)',
            'quantity' => 2,
            'unit_price' => 3750,
            'total' => 7500,
        ]);
    }
}
