<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\StarWars\Character;
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

    private Client $httpClient;

    private $payload;

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
        $id = rand(1, 83);
        $request = $this->httpClient->get("https://swapi.dev/api/people/{$id}/?format=json");
        $this->payload = json_decode($request->getBody()->getContents());

        $character = $this->createOrUpdate();

        $this->info("{$character->name}");

        return 0;
    }

    /**
     * Create or update a character
     *
     * @return  \App\Models\StarWars\Character
     */
    protected function createOrUpdate()
    {
        $character = Character::where('url', $this->payload->url)->first();

        if (!$character) {
            $character = $this->create();
            $this->info("Created");
        } else {
            $this->info("Updated");
            $this->update($character);
        }

        return $character;
    }

    /**
     * Create a new character
     *
     * @return  \App\Models\StarWars\Character
     */
    protected function create()
    {
        return Character::create([
            'name' => $this->payload->name,
            'height' => $this->payload->height,
            'mass' => $this->payload->mass,
            'hair_color' => $this->payload->hair_color,
            'skin_color' => $this->payload->skin_color,
            'eye_color' => $this->payload->eye_color,
            'birth_year' => $this->payload->birth_year,
            'gender' => $this->payload->gender,
            'homeworld' => $this->payload->homeworld,
            'films' => $this->payload->films,
            'species' => $this->payload->species,
            'vehicles' => $this->payload->vehicles,
            'starships' => $this->payload->starships,
            'url' => $this->payload->url,
        ]);
    }

    /**
     * Update a existing character
     *
     * @return  \App\Models\StarWars\Character
     */
    protected function update(Character $character)
    {
        $character->update([
            'name' => $this->payload->name,
            'height' => $this->payload->height,
            'mass' => $this->payload->mass,
            'hair_color' => $this->payload->hair_color,
            'skin_color' => $this->payload->skin_color,
            'eye_color' => $this->payload->eye_color,
            'birth_year' => $this->payload->birth_year,
            'gender' => $this->payload->gender,
            'homeworld' => $this->payload->homeworld,
            'films' => $this->payload->films,
            'species' => $this->payload->species,
            'vehicles' => $this->payload->vehicles,
            'starships' => $this->payload->starships,
            'url' => $this->payload->url,
        ]);

        return $character;
    }
}
