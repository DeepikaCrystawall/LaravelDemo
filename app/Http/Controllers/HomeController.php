<?php

namespace App\Http\Controllers;

use App\Mail\SendContactEmail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend/index');
    }
    public function blogs()
    {
        return view('frontend/blog');
    }

    public function contactus()
    {
        return view('frontend/contactus');

    }
    public function addContact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
            ]);
            
           Contact::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message
           ]);

           $mailData = [
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message
           ];
           Mail::to('deepika.g@crystawall.com')->queue(new SendContactEmail($mailData));

           return back()->with('success', 'Thanks for contacting us!');

    }
}
