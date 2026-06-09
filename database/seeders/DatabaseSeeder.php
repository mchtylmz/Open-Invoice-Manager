<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->callWith(CustomerSeeder::class, ['userId' => $user->id]);
        $this->callWith(ProductSeeder::class, ['userId' => $user->id]);
        $this->callWith(QuoteSeeder::class, ['userId' => $user->id]);
        $this->callWith(InvoiceSeeder::class, ['userId' => $user->id]);
    }
}
