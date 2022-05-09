<?php

namespace Tests\Browser\Pages;

class RegisterPage extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/register';
    }

    /**
     * Submit the form with the given data.
     *
     * @param   \Laravel\Dusk\Browser  $browser
     * @param   array $data
     *
     * @return  void
     */
    public function submit($browser, array $data = [])
    {
        foreach ($data as $key => $value) {
            $browser->type($key, $value);
        }

        $browser->waitForText('Register')
                ->press('Register')
                ->pause(1000);
    }
}
