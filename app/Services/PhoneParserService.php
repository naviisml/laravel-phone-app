<?php

namespace App\Services;

use Illuminate\Support\Facades\Facade;

class PhoneParserService extends Facade
{
    /**
     * Parse the input as text to number
     *
     * @return  void
     */
    public function text(string $input = null)
    {
        if (!$input) {
            return false;
        }

        return $input;
    }

    /**
     * Parse the input as number to text
     *
     * @return  void
     */
    public function number(string $input = null)
    {
        if (!$input) {
            return false;
        }

        return $input;
    }
}
