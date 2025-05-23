<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'brand' => fake()->word(),
            'price' => fake()->numberBetween(100,1000),
            'description' => fake()->paragraph(5),
            'image' => 'product.png',
            'user_id' => function () {
                return User::all()->random();
            }
        ];
    }
}
