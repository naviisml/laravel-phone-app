<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use PhoneParser;
use Str;

class ParserTest extends TestCase
{
    /**
     * Test the `parse:text` command
     *
     * @return  void
     */
    public function test_text_command()
    {
        // execute command
        $this->artisan("parse:text example")
            ->expectsOutput('translated [example] to [339926755533]')
            ->assertExitCode(0);
    }

    /**
     * Test the `parse:number` command
     *
     * @return  void
     */
    public function test_number_command()
    {
        // execute command
        $this->artisan("parse:number 339926755533")
            ->expectsOutput('translated [339926755533] to [example]')
            ->assertExitCode(0);
    }

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
