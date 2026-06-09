<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(int $userId): void
    {
        $products = [
            ['user_id' => $userId, 'name' => 'Web Tasarım Paketi', 'description' => 'Kurumsal web sitesi tasarımı', 'unit_price' => 15000, 'unit_type' => 'adet', 'currency' => 'TRY'],
            ['user_id' => $userId, 'name' => 'SEO Danışmanlık', 'description' => 'Aylık SEO danışmanlık hizmeti', 'unit_price' => 5000, 'unit_type' => 'ay', 'currency' => 'TRY'],
            ['user_id' => $userId, 'name' => 'Yazılım Geliştirme', 'description' => 'Saatlik yazılım geliştirme hizmeti', 'unit_price' => 750, 'unit_type' => 'saat', 'currency' => 'TRY'],
            ['user_id' => $userId, 'name' => 'Sunucu Bakım', 'description' => 'Aylık sunucu bakım ve destek', 'unit_price' => 3000, 'unit_type' => 'ay', 'currency' => 'TRY'],
            ['user_id' => $userId, 'name' => 'Logo Tasarımı', 'description' => 'Profesyonel logo tasarımı', 'unit_price' => 5000, 'unit_type' => 'adet', 'currency' => 'TRY'],
            ['user_id' => $userId, 'name' => 'Sosyal Medya Yönetimi', 'description' => 'Aylık sosyal medya yönetimi', 'unit_price' => 4000, 'unit_type' => 'ay', 'currency' => 'TRY'],
            ['user_id' => $userId, 'name' => 'E-posta Sunucu', 'description' => 'Kurumsal e-posta sunucu kurulumu', 'unit_price' => 2000, 'unit_type' => 'adet', 'currency' => 'TRY'],
            ['user_id' => $userId, 'name' => 'Danışmanlık (Saatlik)', 'description' => 'Teknik danışmanlık hizmeti', 'unit_price' => 1000, 'unit_type' => 'saat', 'currency' => 'TRY'],
        ];

        foreach ($products as $data) {
            Product::create($data);
        }
    }
}
