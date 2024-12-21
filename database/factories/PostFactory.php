<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Post::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(6),
            'views' => $this->faker->numberBetween(0, 1000),
            'rating' => $this->faker->numberBetween(1, 5),
            'status' => $this->faker->numberBetween(1, 2),
            'description' => $this->faker->paragraph(),
            'user_id' => $this->faker->numberBetween(1, 10),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
