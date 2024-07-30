<?php

namespace App\Listeners;

use App\Events\TicketCreation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TicketCreation $event): void
    {
        //
        Mail::to($event->ticket->email)->send(new WelcomeMail($event->ticket));
    }
}
