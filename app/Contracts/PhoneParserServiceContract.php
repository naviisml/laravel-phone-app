<?php

namespace App\Contracts;

interface PhoneParserServiceContract
{
    /**
     * Parse the input as text to number
     *
     * @return  void
     */
    public function text(string $input = null) : String;

    /**
     * Parse the input as number to text
     *
     * @return  string  $this->numberToText
     */
    public function number(string $input = null) : String;
}
