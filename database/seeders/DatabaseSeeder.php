<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Post::factory(50)->create();

        Category::create([
            'name' => 'Laravel',
            'slug' => 'laravel'
        ]);

        Category::create([
            'name' => 'Php',
            'slug' => 'php'
        ]);
    }
}
