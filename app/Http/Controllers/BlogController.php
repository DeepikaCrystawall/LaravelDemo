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
        return view('posts.index', compact('posts', 'title'));
    }

    public function post($id)
    {

        $postquery = Post::orderBy('id','DESC');
        $postquery->where('slug',$id);
        $post = $postquery->first();
        $title = $post->title;

        return view('posts.show-blog', compact('post', 'title'));
    }
}
