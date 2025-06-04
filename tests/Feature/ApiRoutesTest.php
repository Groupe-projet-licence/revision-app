<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Post;
use App\Models\User;

class ApiRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_posts_without_auth_returns_posts_list()
    {
        Post::factory()->count(3)->create();

        $response = $this->getJson('/api/posts');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
        $response->assertJsonStructure([
            '*' => ['id', 'title', 'content', 'created_at', 'updated_at'],
        ]);
    }

    public function test_get_posts_with_authenticated_user()
    {
        Post::factory()->count(3)->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson('/api/quizzes');
        $response->assertStatus(200);
        $response->assertJsonCount(3);
        $response->assertJsonStructure([
            '*' => ['id', 'title', 'content', 'created_at', 'updated_at'],
        ]);
    }
}
