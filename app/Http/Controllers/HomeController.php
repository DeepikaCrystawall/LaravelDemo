<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;

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
}
