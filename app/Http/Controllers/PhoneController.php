<?php

namespace App\Http\Controllers;

use PhoneParser;

class PhoneController extends Controller
{
    /**
     * Handle a text request
     *
     * @return  App\Facades\PhoneParser
     */
    public function text(string $input = null)
    {
        $output = PhoneParser::text($input);

        // TODO: Save the 'translation' to the database

        return response()->json([
            'input' => $input,
            'output' => $output
        ]);
    }

    /**
     * Handle a number request
     *
     * @return  App\Facades\PhoneParser
     */
    public function number(string $input = null)
    {
        $output = PhoneParser::number($input);

        // TODO: Save the 'translation' to the database

        return response()->json([
            'input' => $input,
            'output' => $output
        ]);
    }
}
