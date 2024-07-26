<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
}
