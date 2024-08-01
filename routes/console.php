<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\ProcessJobsCommand;

use App\Console\Commands\RunTests;
use Illuminate\Support\Facades\Log;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


  //Schedule::command('queue:work')->everySecond();
  //Schedule::command('jobs:process')->everyMinute();


  Schedule::command(ProcessJobsCommand::class, ['Taylor', '--force'])->everySecond();
  Schedule::command('queue:work --sleep=1 --tries=3')->everySecond();

  Artisan::command('test:run', function () {
    Log::info('Running tests...');
    Artisan::call(RunTests::class);
});


if (env('APP_ENV') === 'local') {
    $this->app->bind('command.tests.run', function ($app) {
        return new RunTests();
    });

    $this->commands([
        'command.tests.run',
    ]);
}
