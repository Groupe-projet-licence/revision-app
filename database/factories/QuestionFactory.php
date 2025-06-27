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
            //'quiz_id' => Quiz::factory(),
            'type' => $this->faker->randomElement(['single', 'multiple']),
            //'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(), // si aucune catégorie
        ];
    }
}
