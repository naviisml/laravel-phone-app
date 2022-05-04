<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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

        $this->line("[{$output}]");

        return 0;
    }
}
