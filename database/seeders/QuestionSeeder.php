<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {

        // Ensuite crée les questions
        Question::factory(20)->create();
    }
}
