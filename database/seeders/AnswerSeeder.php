<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Answer;

class AnswerSeeder extends Seeder
{
    public function run(): void
    {
        Answer::factory(60)->create(); // 3 réponses en moyenne pour 20 questions
    }
}
