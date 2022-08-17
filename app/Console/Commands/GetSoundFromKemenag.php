<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GetSoundFromKemenag extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dump:file-kemenag';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get file type sound from Kemenag';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return 0;
    }
}
