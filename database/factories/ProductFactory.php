<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoryId = DB::table('categories')->pluck('id');

        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->numberBetween($min = 1000, $max = 2000),
            'category_id' => $this->faker->randomElement($categoryId),
        ];
    }
}
