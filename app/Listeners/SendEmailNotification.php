<?php

namespace App\Listeners;

use App\Events\TicketCreation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\TicketMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Ticket;

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
        
        $ticket = Ticket::with('user')->find($event->ticket->id);
        Mail::to('test@example.com')->send(new TicketMail($ticket));
    }
}
