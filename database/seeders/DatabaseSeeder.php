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
        User::factory()->create([
            'username' => 'testuser',
            'name' => 'Test User',
            'contact' => '9876543210',
            'email' => 'test@example.com',
        ]);

        User::factory(10)->create();
    }
}
