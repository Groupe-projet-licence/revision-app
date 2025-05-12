<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Answer;
use App\Models\Question;

class AnswerFactory extends Factory
{
    protected $model = Answer::class;

    public function definition(): array
    {
        return [
            'answer_text' => $this->faker->sentence(),
            'is_correct' => $this->faker->boolean(25),
            'question_id' => Question::factory(),
        ];
    }
}
