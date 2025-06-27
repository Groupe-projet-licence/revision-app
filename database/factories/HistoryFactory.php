<?php

namespace Database\Factories;

use App\Models\History;
use App\Models\User;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoryFactory extends Factory
{
    protected $model = History::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'quiz_id' => Quiz::factory(),
            'start_time' => now(),
            'end_time' => now()->addMinutes(5),
            'score' => $this->faker->numberBetween(0, 100),
            'correction' => json_encode(['Q1' => 'correct', 'Q2' => 'incorrect']),
        ];
    }
}
