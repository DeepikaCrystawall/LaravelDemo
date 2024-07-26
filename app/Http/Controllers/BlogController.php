<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::get()->all();
        $title = 'Blog | Luis N Vaya | Top Modular Kitchen Service Providers';
        return view('frontend.blog', compact('posts', 'title'));
    }

    public function show($id)
    {
        // Find the post by ID or slug
        $post = Post::findOrFail($id); // Adjust to your needs

        return view('frontend.show-blog', compact('post'));
    }
}
