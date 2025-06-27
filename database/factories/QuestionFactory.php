<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\Category;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition(): array
    {
        return [
            'question_text' => $this->faker->sentence,
<<<<<<< HEAD
            'type' => $this->faker->randomElement(['single', 'multiple']),
            'quiz_id' => Quiz::factory(),
=======
            'quiz_id' => Quiz::factory(),
            'type' => $this->faker->randomElement(['single', 'multiple']),
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(), // si aucune catégorie
>>>>>>> 5717658 (passer un quiz)
        ];
    }
}
