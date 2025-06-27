<?php

namespace Database\Factories;

<<<<<<< HEAD
use App\Models\User;
=======
>>>>>>> 5717658 (passer un quiz)
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
<<<<<<< HEAD
            'title' => $this->faker->sentence(3,true),
            'description' => $this->faker->sentences(3,true),
            'user_id'=>User::factory(),
=======
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'start_time' => now(),
            'end_time' => now()->addHours(2),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(), // 🔒 Sécurité
>>>>>>> 5717658 (passer un quiz)
        ];
    }
}


