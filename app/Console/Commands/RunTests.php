<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class RunTests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
   // protected $signature = 'app:run-tests';
    protected $signature = 'tests:run';


    /**
     * The console command description.
     *
     * @var string
     */
    //protected $description = 'Command description';
    protected $description = 'Run tests and return results';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       // $process = new Process(['php', 'artisan', 'test']);
        $process = new Process(['/usr/bin/php', 'artisan', 'test']);

        $process->run();

        if (!$process->isSuccessful()) {
            $this->error('Test execution failed!');
            return;
        }

        $output = $process->getOutput();
        // Save output to a file or database, e.g., 'storage/test-results.txt'
        file_put_contents(storage_path('test-results.txt'), $output);

        $this->info('Tests executed successfully.');
    }
}
