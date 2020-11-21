<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index(User $user, Post $post)
    {
        $posts = $user->posts()->orderBy('created_at','desc')->paginate(5);

        $follows = (auth()->user()) ? auth()->user()->following->contains($user->profile->id) : false;

        $like = (auth()->user()) ? auth()->user()->like->contains($post->id) : false;

        return view('profile.index', compact('user','posts','follows','like'));
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update()
    {
        $data = request()->validate([
            'user_image' => 'image',
            'about' => '',
        ]);

        if(request('user_image'))
        {
            if(auth()->user()->profile->user_image !== "profile/noimage.jpg")
            {
                Storage::delete('public/'.auth()->user()->profile->user_image);
            }

            $imagePath = request('user_image')->store('profile','public');
            $imageArray =  ['user_image' => $imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect(auth()->user()->username);
    }
}
