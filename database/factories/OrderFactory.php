<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "total" => 0,
            "user_id" => 1,
            "status" => $this->faker->randomElement(["Emballé", "Envoyé", "En route", "Recu", "Retournée", "fermée"]),
        ];
    }
}
