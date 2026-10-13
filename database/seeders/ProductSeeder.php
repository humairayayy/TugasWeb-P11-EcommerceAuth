<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $ownerIds = User::whereIn('role', ['admin', 'editor'])->pluck('id');

        $data = [
            'Smartphone' => ['range' => [1500000, 15000000], 'items' => [
                'Samsung Galaxy A55', 'Xiaomi Redmi Note 13', 'Oppo Reno 11', 'Vivo V30',
                'Realme 12 Pro', 'Infinix Note 40', 'iPhone 13 128GB',
            ]],
            'Laptop' => ['range' => [5000000, 20000000], 'items' => [
                'ASUS Vivobook 14', 'Lenovo IdeaPad Slim 3', 'Acer Aspire 5', 'HP Pavilion 14',
                'Dell Inspiron 15', 'MSI Modern 14', 'Apple MacBook Air M1',
            ]],
            'Aksesoris Gadget' => ['range' => [50000, 800000], 'items' => [
                'Logitech M331 Silent Mouse', 'Keychron K2 Keyboard', 'Anker PowerCore 10000',
                'Baseus Kabel USB-C 1m', 'Sandisk Flashdisk 64GB', 'JBL Tune 510BT', 'Samsung Charger 25W',
            ]],
            'Pakaian Pria' => ['range' => [60000, 450000], 'items' => [
                'Kaos Polos Cotton Combed 30s', 'Kemeja Flanel Lengan Panjang', 'Celana Chino Slim Fit',
                'Jaket Hoodie Fleece', 'Celana Jeans Regular', 'Kemeja Batik Modern', 'Jaket Bomber Parasut',
            ]],
            'Pakaian Wanita' => ['range' => [60000, 400000], 'items' => [
                'Blouse Rayon Motif Bunga', 'Gamis Syari Polos', 'Rok Plisket Panjang',
                'Kardigan Rajut Oversize', 'Hijab Pashmina Ceruti', 'Dress Casual Linen', 'Celana Kulot Highwaist',
            ]],
            'Peralatan Dapur' => ['range' => [40000, 1200000], 'items' => [
                'Rice Cooker Miyako 1.8L', 'Panci Set Stainless 5 Pcs', 'Teflon Anti Lengket 24cm',
                'Blender Philips HR2115', 'Air Fryer Xiaomi 4L', 'Pisau Dapur Stainless', 'Toples Kaca Set 6 Pcs',
            ]],
            'Olahraga' => ['range' => [30000, 1500000], 'items' => [
                'Sepatu Lari Adidas Duramo', 'Matras Yoga TPE 6mm', 'Dumbbell Vinyl 5kg', 'Bola Futsal Molten',
                'Raket Badminton Yonex Astrox', 'Tas Gym Duffle Nike', 'Skipping Rope Speed',
            ]],
            'Buku' => ['range' => [50000, 250000], 'items' => [
                'Laravel untuk Pemula', 'Atomic Habits', 'Filosofi Teras', 'Clean Code',
                'Laut Bercerita', 'Bumi - Tere Liye', 'Pemrograman PHP Modern',
            ]],
        ];

        foreach ($data as $categoryName => $info) {
            $category = Category::firstOrCreate(
                ['slug' => Str::slug($categoryName)],
                ['name' => $categoryName]
            );

            foreach ($info['items'] as $name) {
                Product::factory()->create([
                    'category_id' => $category->id,
                    'user_id'     => $ownerIds->random(),
                    'name'        => $name,
                    'slug'        => Str::slug($name),
                    'price'       => round(rand($info['range'][0], $info['range'][1]) / 1000) * 1000,
                    'stock'       => rand(0, 100),
                    'is_active'   => rand(1, 10) > 1, // ±10% nonaktif
                ]);
            }
        }
    }
}