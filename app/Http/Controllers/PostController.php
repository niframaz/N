<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        
        return view('post.index', compact('posts'));
    }
    
    public function show(Post $post)
    {
        $like = (auth()->user()) ? auth()->user()->like->contains($post->id) : false;
        
        $comments = $post->comments()->latest()->paginate(5);
        
        return view('post.show', compact('post','comments','like'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => '',
            'image' => ['required','image'],
        ]);

        $imagePath = request('image')->store('uploads','public');

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

         return redirect(auth()->user()->username);
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

            return view('post.edit', compact('post'));
    }

    public function update(Post $post)
    {
        $this->authorize('update', $post);

        $data = request()->validate([
            'caption' => '',
        ]);
        
        $post->update(['caption' => $data['caption']]);
        
        return redirect(route('post', $post->id));
    }

    public function delete(Post $post)
    {
        $this->authorize('update', $post);
        $post->delete();

        Storage::delete('public/'.$post->image);

        return redirect(route('profile', auth()->user()->username));
    }
}
