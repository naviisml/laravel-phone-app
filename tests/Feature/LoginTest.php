<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    /**
     * Test the /api/login endpoint
     *
     * @return  void
     */
    public function test_login()
    {
        $user = User::factory()->create();

        $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ])
            ->assertSuccessful()
            ->assertJsonStructure(['token', 'expires_in'])
            ->assertJson(['token_type' => 'bearer']);
    }

    /**
     * Test the /api/login endpoint
     *
     * @return  void
     */
    public function test_login_with_wrong_credentials()
    {
        $this->postJson('/api/login', [
            'email' => 'unknown@email.com',
            'password' => 'password',
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    /**
     * Test the /api/me endpoint
     *
     * @return  void
     */
    public function test_me()
    {
        $this->actingAs(User::factory()->create())
            ->getJson('/api/me')
            ->assertSuccessful()
            ->assertJsonStructure(['id', 'username', 'email']);
    }
}
