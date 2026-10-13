<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('role', 'user')->first();

        foreach (range(1, 8) as $i) {
            $order = Order::create([
                'user_id'      => $user->id,
                'order_number' => 'ORD-' . now()->format('Ymd') . '-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'total'        => 0,
                'status'       => fake()->randomElement(['pending', 'paid', 'shipped', 'completed']),
            ]);

            $total = 0;

            Product::inRandomOrder()->take(rand(1, 3))->get()->each(function ($p) use ($order, &$total) {
                $qty = rand(1, 3);
                $order->items()->create([
                    'product_id' => $p->id,
                    'quantity'   => $qty,
                    'price'      => $p->price,
                ]);
                $total += $p->price * $qty;
            });

            $order->update(['total' => $total]);
        }

        Product::inRandomOrder()->take(15)->get()->each(function ($p) use ($user) {
            Review::create([
                'product_id' => $p->id,
                'user_id'    => $user->id,
                'rating'     => rand(3, 5),
                'comment'    => fake()->sentence(),
            ]);
        });
    }
}