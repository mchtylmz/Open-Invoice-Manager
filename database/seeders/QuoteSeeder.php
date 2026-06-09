<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Quote;
use App\Models\QuoteItem;
use Illuminate\Database\Seeder;

class QuoteSeeder extends Seeder
{
    public function run(int $userId): void
    {
        $customer = Customer::where('user_id', $userId)->skip(1)->first();
        if (!$customer) return;

        $quote = Quote::create([
            'user_id' => $userId,
            'customer_id' => $customer->id,
            'quote_number' => 'QTE-202606-0001',
            'status' => 'sent',
            'issue_date' => now()->subDays(3),
            'valid_until' => now()->addDays(27),
            'subtotal' => 23000,
            'tax_rate' => 20,
            'tax_amount' => 4600,
            'total' => 27600,
            'currency' => 'TRY',
            'notes' => 'Kurumsal paket teklifi',
        ]);

        QuoteItem::create([
            'quote_id' => $quote->id,
            'product_id' => null,
            'description' => 'Web Tasarım Paketi',
            'quantity' => 1,
            'unit_price' => 15000,
            'total' => 15000,
        ]);

        QuoteItem::create([
            'quote_id' => $quote->id,
            'product_id' => null,
            'description' => 'SEO Danışmanlık (1 ay)',
            'quantity' => 1,
            'unit_price' => 5000,
            'total' => 5000,
        ]);

        QuoteItem::create([
            'quote_id' => $quote->id,
            'product_id' => null,
            'description' => 'Logo Tasarımı',
            'quantity' => 1,
            'unit_price' => 3000,
            'total' => 3000,
        ]);
    }
}
