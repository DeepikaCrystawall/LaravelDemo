<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    protected $path = 'assets/post/';

    public function __construct(){
        view()->share('post_menuactive','active');
    }
    
    public function index()
    {
        $posts = Cache::remember('posts', 60, function () {
            return Post::with(['user'])->paginate(10);
        });

        return view('dashboard.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('dashboard.posts.create');
    }

    public function store(PostRequest $request)
    {
        $image = $this->uploadImage($request);

        $post = Post::create(array_merge($request->validated(), [
            'slug' => Str::slug($request->input('title')),
            'image' => $image,
        ]));

        return $post
            ? redirect()->route('posts.index')->with('message', 'Post successfully added.')
            : redirect()->back();
    }

    public function show(Post $post)
    {
        $post->load(['user']);
        return view('dashboard.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', compact('post'));
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        $image = $this->uploadImage($request);
        if ($image) {
            $post->image = $image;
        }

        $post->update(array_merge($request->validated(), [
            'slug' => Str::slug($request->input('title')),
        ]));

        return redirect()->route('posts.index')->with('message', 'Post successfully updated.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $delete = $post->delete();

        return $delete
            ? redirect()->route('posts.index')
            : redirect()->back();
    }

    public function publish(Post $post)
    {
        $post->is_published = !$post->is_published;
        $post->save();

        return redirect()->route('posts.index');
    }

    private function uploadImage(PostRequest $request)
    {
        if ($request->hasFile('images')) {
            $imageFile = $request->file('images');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move($this->path, strtolower($imageName));

            return $imageName;
        }
        
        return null;
    }
}
