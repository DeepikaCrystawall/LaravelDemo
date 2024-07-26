<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;  // Import the Post model

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Post::factory(50)->create(); // Use the Post model factory
    }
}
