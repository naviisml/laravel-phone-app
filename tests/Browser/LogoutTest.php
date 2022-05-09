<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\Browser\Pages\DashboardPage;
use Tests\Browser\Pages\LoginPage;
use Tests\Browser\Pages\HomePage;
use Tests\DuskTestCase;

class LogoutTest extends DuskTestCase
{
    /**
     * Test the 'Sign Out' button
     *
     * @return  void
     */
    public function test_logout()
    {
        $user = User::factory()->create();

        $this->browse(function ($browser) use ($user) {
            $browser->visit(new LoginPage)
                ->submit($user->email, 'password')
                ->on(new DashboardPage)
                ->clickLogout()
                ->assertPageIs(HomePage::class);
        });
    }
}
