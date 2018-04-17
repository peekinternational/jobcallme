<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class sajid extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'echo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'echo hello';

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
        \Log::info('sajid is here');
    }
}
