<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_a_question_with_answers()
    {
        // Simule un utilisateur connecté (si l'auth est requise)
        $user = User::factory()->create();

        // Données à envoyer
        $data = [
            'question_text' => 'Quelle est la capitale du Cameroun ?',
            'type' => 'single',
            'answers' => [
                ['answers_text' => 'Douala', 'is_correct' => false],
                ['answers_text' => 'Yaoundé', 'is_correct' => true],
                ['answers_text' => 'Bamenda', 'is_correct' => false],
            ],
        ];

        // Envoi POST (en tant qu'utilisateur connecté si auth)
        $response = $this->actingAs($user)->post('/questions', $data);

        // Vérifie la redirection (par exemple vers la même page)
        $response->assertRedirect();

        // Vérifie que la question a bien été enregistrée
        $this->assertDatabaseHas('questions', [
            'content' => 'Quelle est la capitale du Cameroun ?',
            'type' => 'single',
        ]);

        // Vérifie qu'il y a bien 3 réponses créées
        $this->assertDatabaseCount('answers', 3);
    }
}
