<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sheet>
 */
class SheetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title"=>fake()->sentence(2),
            "description"=>fake()->optional()->sentence(10),
            "content"=>fake()->paragraph(5),
            'category_id'=>Category::factory()
        ];
    }
}
