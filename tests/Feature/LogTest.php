<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Log;

class LogTest extends TestCase
{
    /**
     * Test the /api/logs endpoint
     *
     * @return  void
     */
    public function test_logs()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api')
            ->getJson('/api/logs')
            ->assertStatus(200)
            ->assertJsonStructure(['data', 'current_page']);
    }

    /**
     * Test the /api/logs/translations endpoint
     *
     * @return  void
     */
    public function test_log_types()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api')
            ->getJson('/api/logs/translation')
            ->assertStatus(200)
            ->assertJsonStructure(['data', 'current_page']);
    }

    /**
     * Test the /api/logs endpoint unauthorized
     *
     * @return  void
     */
    public function test_logs_unauthenticated()
    {
        $this->getJson('/api/logs')
            ->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    }

    /**
     * Test the /api/parser/logs endpoint
     *
     * @return  void
     */
    public function test_log_delete()
    {
        // create a user
        $user = User::factory()->create();

        // create a log
        $log = Log::create([
            'ip_address' => 'LogTest',
			'action' => 'LogTest',
			'data' => [
                'message' => 'LogTest'
            ],
        ]);

        // delete the log
        $this->actingAs($user, 'api')
            ->deleteJson("/api/log/{$log->id}/delete")
            ->assertStatus(200);

        // check if the log still exists
        $this->actingAs($user, 'api')
            ->getJson("/api/log/{$log->id}")
            ->assertStatus(404);
    }
}
