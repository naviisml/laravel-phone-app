<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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

        $this->line("[{$output}]");

        return 0;
    }
}
