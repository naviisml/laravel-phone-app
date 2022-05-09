<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\Browser\Pages\DashboardPage;
use Tests\Browser\Pages\LoginPage;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * Test the /login page
     *
     * @return  void
     */
    public function test_login()
    {
        $user = User::factory()->create();

        $this->browse(function ($browser) use ($user) {
            $browser->visit(new LoginPage)
                    ->submit($user->email, 'password')
                    ->assertPageIs(DashboardPage::class);
        });
    }

    /**
     * Test the /login page with incorrect credentials
     *
     * @return  void
     */
    public function test_login_invalid_credentials()
    {
        $this->browse(function ($browser) {
            $browser->visit(new LoginPage)
                    ->submit('test@test.app', 'password')
                    ->assertSee('These credentials do not match our records.');
        });
    }
}
