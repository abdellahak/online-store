<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "raison_sociale" => fake()->company(),
            "adresse" => fake()->address(),
            "tele" => fake()->unique()->phoneNumber(),
            "email" => fake()->unique()->safeEmail(),
            "description" => fake()->paragraph(),
        ];
    }
}
