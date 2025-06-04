<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthRoutesTest extends TestCase
{
    /** @test */
    public function login_page_is_accessible()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /** @test */
    public function register_page_is_accessible()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }
}
