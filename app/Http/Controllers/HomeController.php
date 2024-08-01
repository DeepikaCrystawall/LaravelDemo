<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Post;
use App\Models\Replies;
use App\Models\Ticket;

use App\Mail\SendContactEmail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Mail;
use App\Traits\SanitizesInput;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


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
      
        $data['home_products']      = Product::with('category')->get();
        $data['home_category']      = Category::get();
        $data['home_blogs']         = Post::orderBy('id', 'desc')->limit(6)->get();
        $data['organic_vegetables'] = Product::with('category')->where('category_id','2')->get();
        $data['organic_fruits']     = Product::with('category')->where('category_id','1')->get();
        
        return view('frontend/index',$data);
    }
    public function blogs()
    {
        return view('frontend/blog');
    }
    public function products()
    {
        $data['categorys']      = Category::with('product')->get();
        $data['products']       = Product::with('category')->get();
        return view('frontend/product',$data);
    }
    public function products_details($id){

        $data['category']           = Category::with('product')->get();
        $data['product'] = $product = Product::with('category')->find($id);
        // Get the category of the product
        $category = $product->category;
        $data['relatedProducts'] = $category->product()->where('id', '!=', $product->id)->get();
        return view('frontend/product_detail',$data);
    }
    public function products_with_category($id)
    {

        // $data['category'] = Category::with('product')->where('id',$id)->get();
        $data['products'] =Product::with('category')->whereHas('category', function($query)use($id) {$query->where('id', $id); }) ->get();

        // dd($data['products']->title);
        $data['categorys']      = Category::get();
        return view('frontend/product',$data);
    }
    // User My account
    public function my_account()
    {
   
        $tickets = Ticket::with('product')->where('user_id',Auth::user()->id)->get();;
        return view('frontend/my_account',compact('tickets'));
    }

    public function user_login(){
        return view('frontend/login');
    }
    public function user_register()
    {
        return view('frontend/register');
    }
    public function profile_update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        $inputs  = $request->all();
        $row     = User::find(Auth::user()->id);
        // print_r($row); exit;
        $row->fill($inputs)->save();
        return redirect()->route('my-account')->with('success','Profile Updated');
    }
    public function view_ticket(Request $request)
    {
        $ticket_id = $request->ticket_id;
       
        $replies = Replies::where('ticket_id', $ticket_id)->get();
        if(!$replies->isEmpty()) 
        {
            $otput = '<table class="table table-striped">
                <thead>
                    <tr>
                        <th>Reply</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>';
                foreach($replies as $reply){
                $otput .='<tr>
                        <td>'.$reply->body.'</td>
                        <td>'.$reply->created_at.'</td>
                    </tr>';
                }
                $otput .='</tbody>
            </table>';
            
        }      
        else
        {
            $otput ='<div>No Replies</div>';
        }
        echo $otput;
    }
    public function user_logout()
    {
            Auth::logout();
            return redirect('/user-login'); # add you login route 
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
