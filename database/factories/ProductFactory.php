<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->words(3, true);

        return [
            'category_id' => Category::factory(),
            'user_id'     => User::factory(),
            'name'        => ucfirst($name),
            'slug'        => Str::slug($name) . '-' . Str::random(5),
            'description' => fake()->paragraph(),
            'price'       => fake()->numberBetween(10, 500) * 10000,
            'stock'       => fake()->numberBetween(0, 100),
            'is_active'   => true,
        ];
    }
}