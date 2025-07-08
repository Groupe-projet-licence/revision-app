<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Sheet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // \App\Models\User::factory(10)->create();
        $user1 = User::factory()->create([
            "name" => "darlin",
            "email" => "donfackdarlin@gmail.com",
            "password" => Hash::make("670748873")
        ]);

        $user = User::factory()->create([
            "name" => "rochelin",
            "email" => "anoumedemrochelin6@gmail.com",
            "password" => Hash::make("698112522")
        ]);

        Sheet::factory()->count(3)->create(['user_id' => 1]);

        $user1->quizzes()->createMany([
            ['title' => 'Laravel', 'description' => 'Ma superbe description du framework Laravel',],
            ['title' => 'Angular', 'description' => 'Ma superbe description du framework Angular',],
            ['title' => 'ReactJs', 'description' => 'Ma superbe description de la librairie ReactJs',]
        ]);

        Quiz::find(1)->questions()->createMany([
            ['question_text' => "Qu'est ce que Laravel", 'type' => 'single'],
            ['question_text' => "Que peut-on faire avec Laravel", 'type' => 'multiple'],
            ['question_text' => "Quels sont les élements semblable a Laravel", 'type' => 'multiple'],
            ['question_text' => "Pourquoi laravel utilise le moteur de template Blade", 'type' => 'single'],
            ['question_text' => "Quel fichier d'un projet laravel est utilise pour gerer les variables de configuration specifiques a l'environnement ", 'type' => 'single'],
        ]);

        Question::find(1)->answers()->createMany([
            ['answer_text' => 'Un framework', 'is_correct' => true],
            ['answer_text' => 'Une librairie', 'is_correct' => false],
            ['answer_text' => 'Un autre nom pour parler de React', 'is_correct' => false],
        ]);
        Question::find(2)->answers()->createMany([
            ['answer_text' => "Developer des applications web", 'is_correct' => true],
            ['answer_text' => 'Créer des API pour gerer la logique backend dans un projet', 'is_correct' => true],
            ['answer_text' => 'Versionner du code', 'is_correct' => false],
            ['answer_text' => "Mettre en place un systeme d'authentification", 'is_correct' => true],
        ]);
        Question::find(3)->answers()->createMany([
            ['answer_text' => 'Angular', 'is_correct' => true],
            ['answer_text' => 'Spring Boot', 'is_correct' => true],
            ['answer_text' => 'React', 'is_correct' => false],
        ]);

        Question::find(4)->answers()->createMany([
            ['answer_text' => 'Pour simplifier la programmation', 'is_correct' => false],
            ['answer_text' => 'Comme modele', 'is_correct' => false],
            ['answer_text' => 'Pour faciliter la creation des controlleurs', 'is_correct' => false],
            ['answer_text' => 'Pour la vue dans le MVC', 'is_correct' => true],
        ]);

        Question::find(5)->answers()->createMany([
            ['answer_text' => '.env.example', 'is_correct' => false],
            ['answer_text' => '.env.local', 'is_correct' => false],
            ['answer_text' => '.env', 'is_correct' => true],
            ['answer_text' => '.config', 'is_correct' => false],
        ]);



        Question::factory(2)->create(["quiz_id" => 2]);

        Answer::factory(4)->create(['question_id' => 6]);
        Answer::factory(3)->create(['question_id' => 7]);



        \App\Models\User::factory(5)->create();
        \App\Models\Quiz::factory(3)->create();
        \App\Models\Category::factory(5)->create();
        \App\Models\Quiz::factory(10)->create();






        $userId = 1;

        $subjects = [
            'Génie Logiciel',
            'Bases de Données',
            'Réseau',
            'Sécurité Informatique',
            'Système d\'exploitation',
            'Architecture des Ordinateurs',
            'Programmation Orientée Objet',
            'Développement Web',
            'Analyse de Données',
            'Administration Système'
        ];

        foreach ($subjects as $subject) {

            // Créer le quiz avec description texte brut
            $quiz = Quiz::create([
                'user_id' => $userId,
                'title' => "Quiz sur $subject",
                'description' => "Ce quiz vous permet d’évaluer vos connaissances en $subject.",
            ]);

            // Nombre de questions aléatoire entre 8 et 14
            $questionCount = rand(8, 14);

            for ($i = 1; $i <= $questionCount; $i++) {

                // Type de question aléatoire : single ou multiple
                $type = rand(0, 1) ? 'single' : 'multiple';

                // Génération de l'énoncé riche en HTML simulant Quill
                $questionText = "<p><strong>Question $i :</strong> Quelle affirmation est correcte concernant <em>$subject</em> ?</p>";

                // Créer la question
                $question = Question::create([
                    'quiz_id' => $quiz->id,
                    'question_text' => $questionText,
                    'type' => $type,
                ]);

                // Nombre d'options aléatoire entre 3 et 6
                $answerCount = rand(3, 6);

                for ($j = 1; $j <= $answerCount; $j++) {

                    // Génération de contenu de réponse enrichi façon Quill
                    $answerText = "<p>";
                    if (rand(0, 1))
                        $answerText .= "<strong>Option $j</strong> : ";
                    if (rand(0, 1))
                        $answerText .= "<em>réponse pour $subject</em> ";
                    if (rand(0, 1))
                        $answerText .= "avec <u>formatage</u>.";

                    // Parfois une liste à puces
                    if (rand(0, 1)) {
                        $answerText .= "<ul><li>Point A</li><li>Point B</li></ul>";
                    }
                    $answerText .= "</p>";

                    Answer::create([
                        'question_id' => $question->id,
                        'answer_text' => $answerText,
                        'is_correct' => $type === 'single'
                            ? ($j === 1) // première réponse correcte pour type single
                            : (rand(0, 1) ? true : false) // choix aléatoire pour type multiple
                    ]);
                }
            }
        }





        $this->call([
            CategorySeeder::class,
            QuestionSeeder::class,
            AnswerSeeder::class,
            QuizSeeder::class,
            HistorySeeder::class,
        ]);


    }


}
