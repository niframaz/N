<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('likes');
    }

    public function store(Post $post)
    {
        auth()->user()->like()->toggle($post);
        
        return redirect()->back();
    }

    public function likes(Post $post)
    {
        $likes = $post->like()->latest()->paginate(5);

        return view('post.likes', compact('likes','post'));
    }
}
