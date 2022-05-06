<?php

namespace Tests\Service;

use Tests\TestCase;
use PhoneParser;
use Str;

class PhoneParserTest extends TestCase
{
    /**
     * A basic string test
     *
     * @return void
     */
    public function test_text()
    {
        $input = 'silas';
        $result = '777744455527777';

        $this->assertEquals(PhoneParser::text($input), $result);
    }

    /**
     * A basic number test
     *
     * @return void
     */
    public function test_number()
    {
        $input = '777744455527777';
        $result = 'silas';

        $this->assertEquals(PhoneParser::number($input), $result);
    }

    /**
     * Multiple random number tests
     *
     * @return void
     */
    public function test_random_nbr()
    {
        foreach(range(1, 10) as $index) {
            $str = random_int(100000, 999999);
            $input = PhoneParser::number($str);
            $result = PhoneParser::text($input);

            $this->assertSame($result, strtolower($str));
        }

        $this->assertTrue(true);
    }
}
