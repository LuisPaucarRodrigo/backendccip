<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FinalMonth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'FinalMonth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //$this->line('Mi comando personalizado se ejecutó correctamente a las ' . now());
    }
}
