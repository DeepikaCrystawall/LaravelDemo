<?php

namespace App\Http\Controllers;

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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::get()->all();
        $title = 'Blog | Luis N Vaya | Top Modular Kitchen Service Providers';
        // return view('frontend.blog', compact('posts', 'title'));
        return view('frontend/blog', compact('posts', 'title'));
    }
    public function blogs()
    {
        return view('frontend/blog');
    }
}
