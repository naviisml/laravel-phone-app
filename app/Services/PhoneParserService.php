<?php

namespace App\Services;

use Illuminate\Support\Facades\Facade;

class PhoneParserService extends Facade
{
    protected $algorithm = [
        "HH" => "*22",
        "a" => "2",
        "b" => "22",
        "c" => "222",
        "d" => "3",
        "e" => "33",
        "f" => "333",
        "g" => "4",
        "h" => "44",
        "i" => "444",
        "j" => "5",
        "k" => "55",
        "l" => "555",
        "m" => "6",
        "n" => "66",
        "o" => "666",
        "p" => "7",
        "q" => "77",
        "r" => "777",
        "s" => "7777",
        "t" => "8",
        "u" => "88",
        "v" => "888",
        "w" => "9",
        "x" => "99",
        "y" => "999",
        "z" => "9999",
        " " => "0",
    ];
    /**
     * Parse the input as text to number
     *
     * @return  string  $this->textToNumber
     */
    public function text(string $input = null)
    {
        return $this->textToNumber($input);
    }

    /**
     * Parse the input as number to text
     *
     * @return  string  $this->numberToText
     */
    public function number(string $input = null)
    {
        return $this->numberToText($input);
    }

    /**
     * Parse the input as number to text
     *
     * @return  string  $input
     */
    protected function textToNumber(string $input = null)
    {
        if (!$input) {
            return false;
        }

        $array = str_split(strtolower($input));
        $output = "";

        // loop over the input
        foreach ($array as $char) {
            // check if the character is in the algorithm array (as key)
            if (isset($this->algorithm[$char])) {
                $output .= $this->algorithm[$char];
            } else {
                $output .= $char;
            }
        }

        return $output;
    }

    /**
     * Parse the input as number to text
     *
     * @return  string  $input
     */
    protected function numberToText(string $input = null)
    {
        if (!$input) {
            return false;
        }

        $array = str_split(strtolower($input));
        $output = "";
        $string = $array[0];

        // loop over the input
        foreach ($array as $index => $char)
        {
            // check if the input exists
            if (isset($array[$index + 1]) && ($result = array_search($string . $array[$index + 1], $this->algorithm))) {
                // save the next character to the string if the parsed result exists with the next character.
                $string .= $array[$index + 1];
                continue;
            } else if (($result = array_search($string, $this->algorithm))) {
                // otherwise, check if the parsed result exists and add it to the output
                $output .= $result;
            } else {
                // Otherwise, add the input back to the output, without parsing
                $output .= $string;
            }

            // Check if the next index exists, to prepare it
            if (isset($array[$index + 1])) {
                $string = $array[$index + 1];
            }
        }

        return $output;
    }
}
