<?php

namespace App\Services;

class PhoneParserService
{
    /**
     * A array holding the translations for the algorithm
     *
     * @var array
     */
    protected array $algorithm = [
        "*"		=>	"*",
        " "		=>	"0",
        "a"		=>	"2",
        "b"		=>	"22",
        "c"		=>	"222",
        "d"		=>	"3",
        "e"		=>	"33",
        "f"		=>	"333",
        "g"		=>	"4",
        "h"		=>	"44",
        "i"		=>	"444",
        "j"		=>	"5",
        "k"		=>	"55",
        "l"		=>	"555",
        "m"		=>	"6",
        "n"		=>	"66",
        "o"		=>	"666",
        "p"		=>	"7",
        "q"		=>	"77",
        "r"		=>	"777",
        "s"		=>	"7777",
        "t"		=>	"8",
        "u"		=>	"88",
        "v"		=>	"888",
        "w"		=>	"9",
        "x"		=>	"99",
        "y"		=>	"999",
        "z"		=>	"9999",
    ];
    /**
     * Parse the input as text to number
     *
     * @return  void
     */
    public function text(string $input = null) : String
    {
        return $this->textToNumber($input);
    }

    /**
     * Parse the input as number to text
     *
     * @return  string  $this->numberToText
     */
    public function number(string $input = null) : String
    {
        return $this->numberToText($input);
    }

    /**
     * Parse the input as number to text
     *
     * @return  string  $output
     */
    protected function textToNumber(string $input = null) : String
    {
        if (!$input) {
            return false;
        }

        $array = str_split(strtolower($input), 1);
        $output = "";

        // loop over the input
        foreach ($array as $index	=>	$char)
        {
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
     * @return  string  $output
     */
    protected function numberToText(string $input = null) : String
    {
        if (!$input) {
            return false;
        }

        $array = str_split(strtolower($input), 1);
        $output = "";
        $string = "";

        // loop over the input
        foreach ($array as $index	=>	$char)
        {
            // check if result exists
            if (($result = array_search(($string . $char), $this->algorithm))) {
                // edge case
                if ($char == "0") {
                    $output .= $result;
                    continue;
                }

                $string .= $char;
            }

            // check if we are at the end of the line,
            // or if the result with the next character doesnt exist
            if (!isset($array[$index + 1]) || !array_search($string . $array[$index + 1], $this->algorithm)) {
                // check if the current result exists,
                // then save the result to the output
                // OR save the string we tried to look-up to the output
                if (($result = array_search($string, $this->algorithm))) {
                    $output .= $result;
                } else {
                    $output .= $char;
                }

                // reset the lookup string
                $string = "";
            }
        }

        // return the results
        return $output;
    }
}
