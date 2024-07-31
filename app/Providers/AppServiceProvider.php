<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use App\Events\UserRegistered;
use App\Events\TicketCreation;
use App\Listeners\SendWelcomeEmail;
use App\Listeners\SendEmailNotification;

class AppServiceProvider extends ServiceProvider
{
    
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

         // Register event and listener
         Event::listen(
            UserRegistered::class,
            [SendWelcomeEmail::class, 'handle']           
        );
        Event::listen(
            TicketCreation::class,
            [SendEmailNotification::class, 'handle']
        );

    }
}
