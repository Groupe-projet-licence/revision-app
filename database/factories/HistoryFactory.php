<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Answer;
use App\Models\Question;
use App\Models\History;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\History>
 */
class HistoryFactory extends Factory
{
    protected $model = History::class;

    public function definition(): array
    {
        // Récupérer ou créer une question
        $question = Question::inRandomOrder()->first() ?? Question::factory()->create();

        // Récupérer les réponses liées à la question
        $answers = Answer::where('question_id', $question->id)->pluck('id')->toArray();

        // Si aucune réponse, en générer 3 par défaut
        if (empty($answers)) {
            $answers = Answer::factory(3)->create([
                'question_id' => $question->id,
            ])->pluck('id')->toArray();
        }

        // Choisir 1 à N réponses aléatoires
        $selectedAnswers = $this->faker->randomElements($answers, rand(1, count($answers)));

        return [
            'question_id' => $question->id,
            'user_answers' => $selectedAnswers,
            'is_correct' => Answer::whereIn('id', $selectedAnswers)
                ->where('is_correct', true)
                ->count() === count($selectedAnswers),
        ];
    }
}
