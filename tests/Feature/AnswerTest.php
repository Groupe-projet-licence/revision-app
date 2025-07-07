<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AnswerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_answer_page_is_accessible()
    {
        $response = $this->get('/answers/create');

        $response->assertStatus(200); // ou 302 si l'utilisateur doit être connecté
    }
    public function create_answer_page_requires_authentication()
{
    $response = $this->get('/answers/create');

    $response->assertRedirect('/login'); // redirige vers login si pas connecté
}

public function authenticated_user_can_access_create_answer_page()
{
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/answers/create');

    $response->assertStatus(200);
}
public function user_can_create_an_answer()
{
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/answers', [
        'content' => 'Ceci est une réponse test',
        'question_id' => 1, // à adapter selon ta DB
    ]);

$response->assertRedirect(); // vérifie la redirection après création

$this->assertDatabaseHas('answers', [
    'content' => 'Ceci est une réponse test',
    ]);
}

}
