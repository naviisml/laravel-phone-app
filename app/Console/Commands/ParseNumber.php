<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Log;
use PhoneParser;

class ParseNumber extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:number {input}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse the number given as string to text format';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $input = $this->argument('input');
        $output = PhoneParser::number($input);

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
