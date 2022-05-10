<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\StarWars\Character;
use App\Models\StarWars\Planet;

class SwapiTest extends TestCase
{
    /**
     * The ID of the character we wanna retrieve/test
     *
     * @return  void
     */
    protected $id = "1";

    /**
     * Test the Star Wars people command (creating character/planet)
     *
     * @return  void
     */
    public function test_swapi_command_create()
    {
        // execute command
        $this->artisan("swapi:character {$this->id}")->assertExitCode(0);

        // find character
        $character = Character::where('character_id', $this->id)->first();

        // check if character exists
        $this->assertTrue($character != null);
        $this->assertTrue($character->planet != null);
    }

    /**
     * Test the Star Wars people command (updating character/planet)
     *
     * @return  void
     */
    public function test_swapi_command_update()
    {
        // execute command
        $this->artisan("swapi:character {$this->id}")->assertExitCode(0);

        // find character
        $character = Character::where('character_id', $this->id)->first();

        // check if character exists
        $this->assertTrue($character != null);
        $this->assertTrue($character->planet != null);
    }
}
