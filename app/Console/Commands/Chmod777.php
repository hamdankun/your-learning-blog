<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;

class Chmod777 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:force-clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command For Set Permission For All File on storage/framework/data';

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
     * @return mixed
     */
    public function handle()
    {
        $directories = File::directories(storage_path('framework/cache/data'));

        foreach ($directories as $key => $directory) {
            info(File::deleteDirectory($directory));
        }
    }
}
