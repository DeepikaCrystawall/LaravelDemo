<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\ProcessJobsCommand;



Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


  //Schedule::command('queue:work')->everySecond();
  //Schedule::command('jobs:process')->everyMinute();


  Schedule::command(ProcessJobsCommand::class, ['Taylor', '--force'])->everySecond();
  Schedule::command('queue:work --sleep=1 --tries=3')->everySecond();


