<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Supplier;
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
            "name" => fake()->unique()->word(),
            "description" => fake()->sentence(10),
            "price" => fake()->randomFloat(2, 1, 300),
            "quantity_store" => fake()->numberBetween(1, 100),
            "category_id" => Category::inRandomOrder()->first()->id,
            "supplier_id" => Supplier::inRandomOrder()->first()->id,
            "image" => "/img/default.jpg",
        ];
    }
}
