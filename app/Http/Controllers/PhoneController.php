<?php

namespace App\Http\Controllers;

use App\Facades\PhoneParser;

class PhoneController extends Controller
{
    /**
     * Handle a text request
     *
     * @return  App\Facades\PhoneParser
     */
    public function text(string $input = null)
    {
        return PhoneParser::text($input);
    }

    /**
     * Handle a number request
     *
     * @return  App\Facades\PhoneParser
     */
    public function number(string $input = null)
    {
        return PhoneParser::number($input);
    }
}
