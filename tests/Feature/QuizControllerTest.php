<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuizControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_a_quiz()
    {
        // Simuler un utilisateur connecté
        $user = User::factory()->create();

        // Créer des questions en base
        $question1 = Question::factory()->create();
        $question2 = Question::factory()->create();

        // Les données à envoyer pour créer le quiz
        $quizData = [
            'title' => 'Quiz de test',
            'description' => 'Ceci est un test',
            'questions' => [$question1->id, $question2->id]
        ];

        // Appeler la route POST /quiz en tant qu'utilisateur
        $response = $this->actingAs($user)->postJson('/quiz', $quizData);

        // Vérifier que la réponse est un succès
        $response->assertStatus(200);

        // Vérifier que le quiz est bien dans la base
        $this->assertDatabaseHas('quizzes', [
            'title' => 'Quiz de test',
            'description' => 'Ceci est un test'
        ]);

        // Vérifier que les relations avec les questions sont bien faites
        $this->assertDatabaseCount('question_quiz', 2); // Table pivot

        // Vérifier la structure de la réponse JSON
        $response->assertJsonStructure([
            'id',
            'title',
            'description',
            'questions' => [
                ['id', 'content'] // selon ta structure de table questions
            ]
        ]);
    }
}
