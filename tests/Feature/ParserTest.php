<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use PhoneParser;
use Str;

class ParserTest extends TestCase
{
    /**
     * Test the /api/parse/text endpoint
     *
     * @return  void
     */
    public function test_parse_text()
    {
        $input = Str::random(10);
        $output = PhoneParser::text($input);

        $this->postJson('/api/parser/text', [
            'text' => $input
        ])
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'input' => $input,
                    'output' => $output
                ]
            ]);
    }

    /**
     * Test the /api/parser/number endpoint
     *
     * @return  void
     */
    public function test_parse_number()
    {
        $input = Str::random(10);
        $output = PhoneParser::number($input);

        $this->postJson('/api/parser/number', [
            'number' => $input
        ])
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'input' => $input,
                    'output' => $output
                ]
            ]);
    }
}
