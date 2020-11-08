<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('following', 'followers');
    }

    public function store(Profile $profile)
    {
        auth()->user()->following()->toggle($profile);
        
        return redirect()->back();
    }

    public function following(\App\Models\User $user)
    {
        $followings = $user->following()->latest()->paginate(5);
        return view('profiles.follows.following', compact('followings','user'));
    }

    public function followers(Profile $profile)
    {
        $followers = $profile->followers()->latest()->paginate(5);
        return view('profiles.follows.followers', compact('followers','profile'));
    }

}
