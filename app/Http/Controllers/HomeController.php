<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;

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
      
        $data['home_products'] = Product::with('category')->get();
        $data['home_category']      = Category::get();
        $data['organic_vegetables'] = Product::with('category')->where('category_id','5')->get();
        $data['organic_fruits'] = Product::with('category')->where('category_id','4')->get();
        
        return view('frontend/index',$data);
    }
    public function blogs()
    {
        return view('frontend/blog');
    }
    public function products()
    {
        $data['categorys']      = Category::get();
        $data['products']       = Product::with('category')->get();
        return view('frontend/product',$data);
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
