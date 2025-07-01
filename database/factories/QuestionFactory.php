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
            'question_text' => $this->faker->sentence(),
           // 'category_id' => Category::factory(),
            'type' => $this->faker->randomElement(['single', 'multiple']),
        ];
    }
}
