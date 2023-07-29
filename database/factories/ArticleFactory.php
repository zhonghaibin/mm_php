<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'author' => fake()->name(),
            'description' => fake()->text(10),
            'keywords' => fake()->text(10),
            'status' => 1,
            'is_top' => 0,
        ];
    }
}
