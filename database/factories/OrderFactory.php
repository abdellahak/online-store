<?php

namespace Database\Factories;

use App\Models\User;
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
            "user_id" => User::inRandomOrder()->first()->id,
            "status" => $this->faker->randomElement(["Emballé", "Envoyé", "En route", "Recu", "Retournée", "fermée"]),
            "payment_type" => $this->faker->randomElement(["cod", "online"]),
            "created_at" => $this->faker->dateTimeBetween('-3 year', 'now'),
            "updated_at" => $this->faker->dateTimeBetween('-3 year', 'now'),
        ];
    }
}
