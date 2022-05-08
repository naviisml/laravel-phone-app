<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class LogoutTest extends TestCase
{
    /**
     * Test the /api/logout endpoint
     *
     * @return  void
     */
    public function test_logout_endpoint()
    {
        $token = $this->postJson('/api/login', [
            'email' => User::factory()->create()->email,
            'password' => 'password',
        ])->json()['token'];

        $this->postJson("/api/logout?token=$token")
            ->assertSuccessful();

        $this->getJson("/api/me?token=$token")
            ->assertStatus(401);
    }
}
