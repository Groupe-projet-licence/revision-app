<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Question;
use App\Models\Quiz;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz>
 */
class QuizFactory extends Factory
{
    protected $model = Quiz::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Quiz $quiz) {
            $questions = Question::inRandomOrder()->limit(3)->pluck('id');
            $quiz->questions()->sync($questions);
        });
    }
}
