<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Log;
use PhoneParser;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = Str::random(15);
        $output = PhoneParser::text($input);

        Log::factory()
                ->count(50)
                ->state([
                    'action' => 'translation',
                    'data' => [
                        'input' => $input ?? null,
                        'output' => $output ?? null
                    ]
                ])
                ->create();
    }
}
