<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class RegisterTest extends TestCase
{
    /**
     * Test the /api/register endpoint
     *
     * @return void
     */
    public function test_register()
    {
        $this->postJson('/api/register', [
            'username' => 'Test User',
            'email' => 'test@test.app',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ])
            ->assertSuccessful()
            ->assertJsonStructure(['id', 'username', 'email']);
    }

    /**
     * Test the /api/register endpoint with a existing email
     *
     * @return  void
     */
    public function test_register_with_existing_email()
    {
        User::factory()->create(['email' => 'test@test.app']);

        $this->postJson('/api/register', [
            'username' => 'Test User',
            'email' => 'test@test.app',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }
}
