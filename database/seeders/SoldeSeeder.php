<?php

namespace Database\Seeders;

use App\Models\Solde;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SoldeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Solde::factory(10)->create();

    }
}
