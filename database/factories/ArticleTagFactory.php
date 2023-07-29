<?php

namespace Database\Factories;

use App\Models\ArticleTag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ArticleTagFactory>
 */
class ArticleTagFactory extends Factory
{
    protected $model = ArticleTag::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'flag' => fake()->text(6),
        ];
    }
}
