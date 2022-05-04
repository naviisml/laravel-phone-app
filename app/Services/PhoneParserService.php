<?php

namespace App\Services;

use Illuminate\Support\Facades\Facade;

class PhoneParserService extends Facade
{
    protected $algorithm = [
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
            // check if the next character is the same, add to string
            if (isset($array[$index + 1]) && $array[$index + 1] == $char) {
                $string .= $char;
                continue;
            }

            // Look in array for result
            if (($result = array_search($string, $this->algorithm))) {
                $output .= $result;
            }
            // reset $string, set the next character
            if (isset($array[$index + 1])) {
                $string = $array[$index + 1];
            }
        }

        return $output;
    }
}
