<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CategoryFactory>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_id' => fake()->title(),
            'name' => fake()->name(),
            'flag' => fake()->text(6),
            'keywords' => fake()->text(10),
            'description' => fake()->text(10),
            'sort' => 0,
        ];
    }
}
