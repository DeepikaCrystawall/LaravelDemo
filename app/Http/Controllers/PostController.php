<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Cache;


class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with(['user'])->paginate(10);

        return view('dashboard.posts.index', compact('posts'));
    }


    public function create()
    {


        return view('dashboard.posts.create');
    }



    public function store(Request $request)
            {                 

                  $data = $request->all();
                $path = 'assets/post/';
                $destinationPath    = $path;
                $image_file         =$request->file('images');
                $image = '';
                if($image_file){
                $file_size = $image_file->getSize();

                    $image_name         = $image_file->getClientOriginalName();
                    $extention          = $image_file->getClientOriginalExtension();
                    $image = value(function() use ($image_file){
                    $filename = time().'.'. $image_file->getClientOriginalExtension();
                    return strtolower($filename);
                    });
                    $image_file->move($destinationPath, $image);

                }


                  $post = Post::create([
                    'title'            => $data['title'],
                    'body'       => $data['body'],
                    'meta_tag'       => $data['meta_tag'],
                    'meta_description'       => $data['meta_description'],
                    'slug'       => Str::slug($data['title']),
                    'keywords'       => $data['keywords'],
                    'image'        => $image,
                    'tags'    => $data['tags']
                   ]);
                 if(isset($post)) {
                  return redirect()->route('posts.index')->with('message','Student successfully added.');
                  }else{
                      return redirect()->back();
                  }
            }

    public function show(Post $post)
    {
        $post = $post->load(['user']);
        return view('dashboard.posts.show', compact('post'));
    }


    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', compact('post'));
    }




    public function update(Request $request, $id)
    {        
        $post = Post::findOrFail($id);

        $path = 'assets/post/';
                $destinationPath    = $path;
                $image_file         =$request->file('images');
                $image = '';
                if($image_file){
                $file_size = $image_file->getSize();

                    $image_name         = $image_file->getClientOriginalName();
                    $extention          = $image_file->getClientOriginalExtension();
                    $image = value(function() use ($image_file){
                    $filename = time().'.'. $image_file->getClientOriginalExtension();
                    return strtolower($filename);
                    });
                    $image_file->move($destinationPath, $image);

        $post->image            = $image;
        }
        $post->title            = $request->input('title');
        $post->body            = $request->input('body');
        $post->meta_tag            = $request->input('meta_tag');
        $post->meta_description            = $request->input('meta_description');
        $post->slug            = Str::slug($request->input('title'));
        $post->keywords            = $request->input('keywords');

        $post->tags         =$request->input('tags');


        $upate = $post->save();


        if(isset($upate)) {
            return redirect()->route('posts.index')->with('message','Posts successfully Updated.');
        }else{
            return redirect()->back();
        }
    }


    public function destroy($id)
    {
        $post   = Post::findOrFail($id);
        $delete     = $post->delete();
        if(isset($delete)) {
           return redirect()->route('posts.index');
        }else{
            return redirect()->back();
        }
    }


    public function publish(Post $post)
    {
        $post->is_published = !$post->is_published;
        $post->save();


        return redirect()->route('posts.index');
    }
}