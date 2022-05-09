<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class DashboardPage extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/user/user-dashboard';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param   \Laravel\Dusk\Browser  $browser
     *
     * @return  void
     */
    public function assert(Browser $browser)
    {
        $browser->waitForLocation($this->url())->assertPathIs($this->url());
    }

    /**
     * Click on the log out link.
     *
     * @param   \Laravel\Dusk\Browser  $browser
     *
     * @return  void
     */
    public function clickLogout($browser)
    {
        $browser->waitForText('Sign Out')
                ->clickLink('Sign Out');
    }
}
