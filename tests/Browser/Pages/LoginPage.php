<?php

namespace Tests\Browser\Pages;

class LoginPage extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/login';
    }

    /**
     * Submit the form with the given data.
     *
     * @param   string  $browser   [$browser description]
     * @param   string  $email     [$email description]
     * @param   string  $password  [$password description]
     *
     * @return  void
     */
    public function submit($browser, $email, $password)
    {
        $browser->waitForText('Sign In')
                ->type('email', $email)
                ->type('password', $password)
                ->press('Sign In')
                ->pause(500);
    }
}
