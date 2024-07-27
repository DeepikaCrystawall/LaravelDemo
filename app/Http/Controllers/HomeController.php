<?php

namespace App\Http\Controllers;

use App\Mail\SendContactEmail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Mail;
use App\Traits\SanitizesInput;


class HomeController extends Controller
{
    use SanitizesInput;
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
        // Sanitize individual inputs or an array of inputs
        $sanitizedInputs = $this->sanitizeInputFields([
            'name' => $request->input('name'),
            'message' => $request->input('message'),
        ]);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
            ]);
            
           Contact::create([
            'name'=>$sanitizedInputs['name'],
            'email'=>$request->email,
            'message'=>$sanitizedInputs['message']
           ]);

           $mailData = [
            'name'=>$sanitizedInputs['name'],
            'email'=>$request->email,
            'message'=>$sanitizedInputs['message']
           ];
           Mail::to('deepika.g@crystawall.com')->queue(new SendContactEmail($mailData));

           return back()->with('success', 'Thanks for contacting us!');

    }
}
