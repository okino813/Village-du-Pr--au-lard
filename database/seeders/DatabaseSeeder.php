<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Place;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'firstname' => 'Test User',
            'lastname' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('admin1234'),
        ]);

        // // On crée les catégories
        // Category::factory()->create([
        //     'name' => 'Restaurant',
        //     'slug' => 'restaurant',
        // ]);

        // Category::factory()->create([
        //     'name' => 'Magasin',
        //     'slug' => 'magasin',
        // ]);

        // Category::factory()->create([
        //     'name' => 'Habitant',
        //     'slug' => 'habitant',
        // ]);

        // User::factory(10)->create();
    }
}
