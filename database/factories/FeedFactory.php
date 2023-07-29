<?php

namespace Database\Factories;

use App\Models\Feed;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FeedFactory>
 */
class FeedFactory extends Factory
{
    protected $model = Feed::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'target_type' => 1,
            'target_id' => fake()->uuid(),
            'content' => fake()->text(),
            'html' => fake()->text(),
        ];
    }
}
