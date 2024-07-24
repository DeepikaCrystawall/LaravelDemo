<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
<<<<<<< HEAD
    public function index()
=======
    public function ticketListing()
>>>>>>> 5651992734c25dcf60a80f2b4da1032346d5d6b5
    {
        $tickets = Ticket::with('user') // Assuming 'user' is the relationship method in Ticket model
        ->orderBy('created_at', 'desc')
        ->paginate(10); // Adjust pagination as per your preference

        return view('admin.tickets.list',compact('tickets'));
    }
<<<<<<< HEAD

    public function show(Request $request)
    {

    }
=======
>>>>>>> 5651992734c25dcf60a80f2b4da1032346d5d6b5
}
