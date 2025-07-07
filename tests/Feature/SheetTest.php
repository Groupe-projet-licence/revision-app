<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Sheet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SheetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_access_sheet_creation_page()
    {
        $response = $this->get('/sheets/create');
        $response->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_user_can_access_sheet_creation_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/sheets/create');
        $response->assertStatus(200);
    }

    /** @test */
    public function authenticated_user_can_create_a_sheet()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/sheets', [
            'title' => 'Ma première fiche',
            'content' => 'Voici le contenu de la fiche',
        ]);

        $response->assertRedirect(); // ou assertRedirect('/sheets')
        $this->assertDatabaseHas('sheets', [
            'title' => 'Ma première fiche',
            'content' => 'Voici le contenu de la fiche',
        ]);
    }

    /** @test */
    public function sheet_creation_fails_with_invalid_data()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/sheets', [
            'title' => '', // vide
            'content' => '', // vide
        ]);

        $response->assertSessionHasErrors(['title', 'content']);
    }

    /** @test */
    public function guest_cannot_post_a_sheet()
    {
        $response = $this->post('/sheets', [
            'title' => 'Fiche invité',
            'content' => 'Tentative de création',
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseMissing('sheets', [
            'title' => 'Fiche invité',
        ]);
    }
    /** @test */
  public function authenticated_user_can_manage_a_sheet_completely()
 {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Création
    $response = $this->post('/sheets', [
        'title' => 'Fiche complète',
        'content' => 'Contenu complet',
    ]);
    $response->assertRedirect();
    $this->assertDatabaseHas('sheets', ['title' => 'Fiche complète']);

    $sheet = Sheet::first();

    // Visualisation
    $response = $this->get("/sheets/{$sheet->id}");
    $response->assertStatus(200);

    // Modification
    $response = $this->put("/sheets/{$sheet->id}", [
        'title' => 'Fiche modifiée',
        'content' => 'Contenu modifié',
    ]);
    $response->assertRedirect();
    $this->assertDatabaseHas('sheets', ['title' => 'Fiche modifiée']);

    // Suppression
    $response = $this->delete("/sheets/{$sheet->id}");
    $response->assertRedirect();
    $this->assertDatabaseMissing('sheets', ['id' => $sheet->id]);
 }

}
