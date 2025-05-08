<?php

namespace Database\Factories;

use App\Models\Solde;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class SoldeFactory extends Factory
{

    public function definition()
    {
        return [
            'value' => $this->faker->numberBetween(10, 50),
            'product_id' => 1,
            'category_id' => 1,
            'starts_at' => now()->subDays(3),
            'ends_at' => now()->addDays(7),
        ];
    }
}