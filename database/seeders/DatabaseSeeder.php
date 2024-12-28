<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Pemilik Kost',
            'email' => 'pemilikkost@example.com',
            'is_pemilik_kost' => true,
        ]);

        User::factory()->create([
            'name' => 'Pengelola Kost',
            'email' => 'pengelolakost@example.com',
            'is_pemilik_kost' => false,
        ]);
    }
}
