<?php

namespace App\Listeners;

use App\Events\TicketCreation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\TicketMail;
use Illuminate\Support\Facades\Mail;

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
        Mail::to('test@example.com')->send(new TicketMail($event->ticket));
    }
}
