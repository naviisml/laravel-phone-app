<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Log;
use PhoneParser;

class ParseText extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:text {input}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse the text given as string to number format';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $input = $this->argument('input');
        $output = PhoneParser::text($input);

        // log the action
		$log = Log::create([
			'ip_address' => 'console',
			'action' => 'translation',
			'data' => [
                'input' => $input ?? null,
                'output' => $output ?? null
            ],
		]);

        // print the translation
        $this->line("translated [{$input}] to [{$output}]");

        return 0;
    }
}
