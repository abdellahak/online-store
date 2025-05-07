<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'abdo',
            'email' => 'abdo@example.com',
            'password' => Hash::make('abdo@example.com'),
            'role' => 'admin',
            'balance' => 5000,
            'is_super_admin' => false
        ]);

        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'balance' => 0,
            'is_super_admin' => true
        ]);
    }
}
