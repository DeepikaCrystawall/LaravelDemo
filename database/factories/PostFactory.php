<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'meta_tag' => $this->faker->word,
            'meta_description' => $this->faker->text,
            'slug' => $this->faker->slug,
            'keywords' => $this->faker->words(3, true),
            'image' => $this->faker->imageUrl(),
            'tags' => $this->faker->words(5, true),
            'is_published' => $this->faker->boolean,
        ];
    }
}
