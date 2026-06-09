<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(int $userId): void
    {
        $customers = [
            ['user_id' => $userId, 'name' => 'Acme Corporation', 'email' => 'info@acme.com', 'phone' => '0212 555 0101', 'address' => 'Levent, İstanbul', 'tax_number' => '1234567890'],
            ['user_id' => $userId, 'name' => 'Tech Solutions Ltd.', 'email' => 'contact@techsol.com', 'phone' => '0216 555 0202', 'address' => 'Kadıköy, İstanbul', 'tax_number' => '2345678901'],
            ['user_id' => $userId, 'name' => 'Ahmet Yılmaz', 'email' => 'ahmet@email.com', 'phone' => '0532 555 0303', 'address' => 'Çankaya, Ankara', 'tax_number' => null],
            ['user_id' => $userId, 'name' => 'Zeynep Demir', 'email' => 'zeynep@email.com', 'phone' => '0541 555 0404', 'address' => 'Konak, İzmir', 'tax_number' => null],
            ['user_id' => $userId, 'name' => 'Mega İnşaat A.Ş.', 'email' => 'info@megainsaat.com', 'phone' => '0312 555 0505', 'address' => 'Sincan, Ankara', 'tax_number' => '3456789012'],
        ];

        foreach ($customers as $data) {
            Customer::create($data);
        }
    }
}
