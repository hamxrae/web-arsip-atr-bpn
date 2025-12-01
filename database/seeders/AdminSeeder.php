<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah user admin sudah ada
        if (!\App\Models\User::where('email', 'admin@example.com')->exists()) {
            \App\Models\User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('firman123'),
            ]);
        }
    }
}
