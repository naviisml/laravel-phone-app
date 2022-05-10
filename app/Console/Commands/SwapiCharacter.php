<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\StarWars\Character;
use App\Models\StarWars\Planet;
use GuzzleHttp\Client;

class SwapiCharacter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swapi:character';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve a star wars character from the swapi.';

    /**
     * The GuzzleHttp Client instance
     *
     * @var \GuzzleHttp\Client
     */
    private Client $httpClient;

    /**
     * The character data
     *
     * @var array
     */
    private $character;

    /**
     * The planet data
     *
     * @var array
     */
    private $planet;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->character = $this->request("https://swapi.dev/api/people/" . rand(1, 83) . "/?format=json");
        $this->planet = $this->request($this->character->homeworld);

        $character = $this->createOrUpdateCharacter();
        $planet = $this->createOrUpdatePlanet();

        $character->update([
            'homeworld' => $planet->id
        ]);

        return 0;
    }

    /**
     * Make a API request
     *
     * @param   string  $url
     *
     * @return  array
     */
    protected function request($url)
    {
        $request = $this->httpClient->get($url);
        $payload = json_decode($request->getBody()->getContents());

        return $payload;
    }

    /**
     * Create or update a character
     *
     * @return  \App\Models\StarWars\Character
     */
    protected function createOrUpdateCharacter()
    {
        $character = Character::where('url', $this->character->url)->first();

        if (!$character) {
            $character = $this->createCharacter();
            $this->info("Character [{$character->name}] added to database");
        } else {
            $this->updateCharacter($character);
            $this->info("Character [{$character->name}] updated in database");
        }

        return $character;
    }

    /**
     * Create a new character
     *
     * @return  \App\Models\StarWars\Character
     */
    protected function createCharacter()
    {
        return Character::create([
            'name' => $this->character->name,
            'height' => $this->character->height,
            'mass' => $this->character->mass,
            'hair_color' => $this->character->hair_color,
            'skin_color' => $this->character->skin_color,
            'eye_color' => $this->character->eye_color,
            'birth_year' => $this->character->birth_year,
            'gender' => $this->character->gender,
            'films' => $this->character->films,
            'species' => $this->character->species,
            'vehicles' => $this->character->vehicles,
            'starships' => $this->character->starships,
            'url' => $this->character->url,
        ]);
    }

    /**
     * Update a existing character
     *
     * @return  \App\Models\StarWars\Character
     */
    protected function updateCharacter(Character $character)
    {
        $character->update([
            'name' => $this->character->name,
            'height' => $this->character->height,
            'mass' => $this->character->mass,
            'hair_color' => $this->character->hair_color,
            'skin_color' => $this->character->skin_color,
            'eye_color' => $this->character->eye_color,
            'birth_year' => $this->character->birth_year,
            'gender' => $this->character->gender,
            'films' => $this->character->films,
            'species' => $this->character->species,
            'vehicles' => $this->character->vehicles,
            'starships' => $this->character->starships,
            'url' => $this->character->url,
        ]);

        return $character;
    }



    /**
     * Create or update a planet
     *
     * @return  \App\Models\StarWars\Planet
     */
    protected function createOrUpdatePlanet()
    {
        $planet = Planet::where('url', $this->planet->url)->first();

        if (!$planet) {
            $planet = $this->createPlanet();
            $this->info("Planet [{$planet->name}] added to database");
        } else {
            $this->updatePlanet($planet);
            $this->info("Planet [{$planet->name}] updated in database");
        }

        return $planet;
    }

    /**
     * Create a new planet
     *
     * @return  \App\Models\StarWars\Planet
     */
    protected function createPlanet()
    {
        return Planet::create([
            'name' => $this->planet->name,
            'climate' => $this->planet->climate,
            'diameter' => $this->planet->diameter,
            'gravity' => $this->planet->gravity,
            'orbital_period' => $this->planet->orbital_period,
            'population' => $this->planet->population,
            'rotation_period' => $this->planet->rotation_period,
            'surface_water' => $this->planet->surface_water,
            'terrain' => $this->planet->terrain,
            'url' => $this->planet->url,
        ]);
    }

    /**
     * Update a existing character
     *
     * @return  \App\Models\StarWars\Planet
     */
    protected function updatePlanet(Planet $planet)
    {
        $planet->update([
            'name' => $this->planet->name,
            'climate' => $this->planet->climate,
            'diameter' => $this->planet->diameter,
            'gravity' => $this->planet->gravity,
            'orbital_period' => $this->planet->orbital_period,
            'population' => $this->planet->population,
            'rotation_period' => $this->planet->rotation_period,
            'surface_water' => $this->planet->surface_water,
            'terrain' => $this->planet->terrain,
            'url' => $this->planet->url,
        ]);

        return $planet;
    }
}
