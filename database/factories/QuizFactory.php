<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'start_time' => now(),
            'end_time' => now()->addHours(2),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(), // 🔒 Sécurité
        ];
    }
}


