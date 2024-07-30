<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'short_desc' => $this->faker->paragraph,
            'description' => $this->faker->paragraph,
            'category_id' => 1,
            'price' => $this->faker->randomDigit,
            'image_alt' =>$this->faker->word(),
            'image' => '1721998322.jpg',
            'status' => 1,
             ];
    }
}
