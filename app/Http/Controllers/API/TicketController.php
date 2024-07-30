<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Notifications\TicketUpdatedNotification;


//use Illuminate\Support\Facades\Auth;


class TicketController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::paginate(10);

        $tickets->getCollection()->transform(function ($ticket) {
            // Example: Attach a URL or base64 encoded file to each user
            $filePath = 'attachments/'.$ticket->attachment;

            if (Storage::disk('public')->exists($filePath)) {
                    $fileContents = Storage::disk('public')->get($filePath); 
                    $ticket->attachment = base64_encode($fileContents);           
                }
                else{
                    $fileContents = '';
                    $ticket->attachment = ''; 
                }

            return $ticket;
        });
      
        return $this->sendResponse($tickets,'Tickets Listed successfully');
    

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
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        $ticket = Ticket::create([
            'title'       => $request->title,
            'description' => $request->description,
            'user_id'     => auth()->id(),
        ]);
        if ($request->file('attachment')) {
            $this->storeAttachment($request, $ticket);
        }    

        return $this->sendResponse($ticket, 'Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $ticket = Ticket::find($id);
         if($ticket != '')
         {
            return $this->sendResponse($ticket,'Ticket Details');

         }else{
            return $this->sendError('Ticket Not Found','');

         }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if($request->file('attachment') != '')
        {
            Storage::disk('public')->delete($ticket->attachment);
            $this->storeAttachment($request, $ticket);
        }

         Ticket::where('id',$id)->update([
            'title'=>$request->title,
            'description' =>$request->description,            
        ]);
        return $this->sendResponse($ticket,'Ticket Updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Ticket::destroy($id);
        return $this->sendResponse('','Ticket Deleted');

        
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

   
}
