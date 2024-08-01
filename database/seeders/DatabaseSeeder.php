<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\Post;  // Import the Post model
use App\Models\User;  // Import the Post model
use App\Models\Ticket;  // Import the Post model
use App\Models\Product;  // Import the Post model

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->count(10)->create();

        Ticket::factory()->count(20)->create();

        Post::factory(50)->create(); // Use the Post model factory

        Product::factory()->count(10)->create();
        Category::factory()->count(2)->create();

    }
}
