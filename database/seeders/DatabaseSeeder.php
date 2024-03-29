<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory()->create([
             'name'     => 'Test User',
             'email'    => 'test@example.com',
             'password' => bcrypt('password'),
         ]);

         \App\Models\Salary::factory(30)->create();

         $this->call(MovieSeeder::class);
    }
}
