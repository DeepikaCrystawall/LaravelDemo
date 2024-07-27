<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;


class ProcessJobsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
   // protected $signature = 'app:process-jobs-command';

    /**
     * The console command description.
     *
     * @var string
     */
   // protected $description = 'Command description';

    protected $signature = 'jobs:process';
    protected $description = 'Process queued jobs';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        Artisan::call('queue:work', [
            '--queue' => 'default', 
            '--sleep' => 3,        
            '--tries' => 3         
        ]);

        $this->info('Queue processing started.');
    }
}
