<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('following', 'followers');
    }

    public function store(Profile $profile)
    {
        if(auth()->user()->id !== $profile->id)
        {
        auth()->user()->following()->toggle($profile);
        }
    }

    public function following(User $user)
    {
        $followings = $user->following()->latest()->paginate(5);
        return view('profile.follow.following', compact('followings','user'));
    }

    public function followers(User $user)
    {
        $followers = $user->profile->followers()->latest()->paginate(5);
        return view('profile.follow.followers', compact('followers','user'));
    }
}
