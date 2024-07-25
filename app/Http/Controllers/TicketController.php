<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Replies;

use App\Models\Ticket;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Notifications\TicketUpdatedNotification;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function ticketlisting()
    {
       
        $user    = auth()->user();
       
        $tickets = $user->isAdmin ? Ticket::latest()->get() : $user->tickets;
        return view('ticket.index', compact('tickets'));
    }

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
        return view('ticket.create');
    }

     /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        
        $ticket = Ticket::create([
            'title'       => $request->title,
            'description' => $request->description,
            'user_id'     => auth()->id(),
        ]);

        if ($request->file('attachment')) {
            $this->storeAttachment($request, $ticket);
        }        
        return redirect()->route('ticket.index')->with('success','Ticket created successfully.');
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('ticket.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        return view('ticket.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $ticket->update($request->except('attachment'));

        if ($request->has('status')) {
            // $user = User::find($ticket->user_id);
            $ticket->user->notify(new TicketUpdatedNotification($ticket));
        }

        if ($request->file('attachment')) {
            Storage::disk('public')->delete($ticket->attachment);
            $this->storeAttachment($request, $ticket);
        }        
        return redirect()->route('ticket.index')->with('success','Ticket updated successfully.');
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect(route('ticket.index'));
    }

    protected function storeAttachment($request, $ticket)
    {
        $ext      = $request->file('attachment')->extension();
        $contents = file_get_contents($request->file('attachment'));
        $filename = Str::random(25);
        $path     = "attachments/$filename.$ext";
        Storage::disk('public')->put($path, $contents);
        $ticket->update(['attachment' => $path]);
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

        $ticket->user->notify(new TicketUpdatedNotification($ticket));

        // Return updated status
        return response()->json(['status' => $ticket->status]);
    }

    public function replyticket(Request $request)
    {
        $ticketid = $request->ticketid;
        $ticketdetails = Ticket::where('id',$ticketid)->first();        // dd($ticketdetails);

        $replies = Replies::where('ticket_id',$ticketid)->get();
        return view('admin.tickets.reply',compact('ticketdetails','replies'));
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
