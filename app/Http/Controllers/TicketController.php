<?php

namespace App\Http\Controllers;
use App\Models\Ticket;
use App\Models\Replies;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::with('user') // Assuming 'user' is the relationship method in Ticket model
        ->orderBy('created_at', 'desc')
        ->paginate(10); // Adjust pagination as per your preference

        return view('admin.tickets.list',compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function toggleStatus(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        // Validate request data if necessary
        $request->validate([
            'status' => 'required|in:open,resolved,rejected',
        ]);

        // Update status
        $ticket->status = $request->status;
        $ticket->save();

        // Return updated status
        return response()->json(['status' => $ticket->status]);
    }

    public function replyticket(Request $request)
    {
        $ticketid = $request->ticketid;
        $ticketdetails = Ticket::where('id',$ticketid)->first();        // dd($ticketdetails);

        return view('admin.tickets.reply',compact('ticketdetails'));
    }
    public function replyupdate(Request $request, Ticket $ticket)
    {
        // Validate the request
        $validator = $request->validate([
            'content' => 'required|string',

        ]);


        // Create new ticket reply
        $reply = new Replies();
        $reply->ticket_id = $request->ticketid;
        $reply->body = $request->input('content');
        // Optionally, you might want to associate the reply with the logged-in user
        $reply->user_id = auth()->user()->id;
        $reply->save();

        return redirect()->route('ticket.index')->with('success','Reply submitted successfully.');
        //response()->json(['message' => 'Reply submitted successfully.']);
    }

}
