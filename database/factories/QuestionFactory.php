<?php
namespace Database\Factories;

use App\Models\Question;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition(): array
    {
        return [
            'question_text' => $this->faker->sentence(),
            'category_id' => Category::factory(),
            'type' => $this->faker->randomElement(['single', 'multiple']),
        ];
    }
}
