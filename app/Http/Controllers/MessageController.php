<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $messages = auth()->user()->inbox->messages()->latest()->paginate(5);
        return view('messages.index',compact('messages'));
    }

   public function create(User $user)
   {
    //$this->authorize('create' , $user);
    if (auth()->user()->id !== $user->id)
    {
       return view('messages.create', compact('user'));
    }
    else
    {
        return redirect()->back()->with('error','Bad request');
    }
   }

   public function store(User $user)
   {
        //$this->authorize('create' , $user);

        $data = request()->validate([
            'message' => 'required'
        ]);

        if (auth()->user()->id !== $user->id)
        {
            $message = new \App\Models\Message;
            $message->user_id = auth()->user()->id;
            $message->inbox_id = $user->inbox->id;
            $message->message = $data['message'];
            $message->save();

            return redirect('message/'.$user->username)->with('success','Message Sent');
        }
        else
        {
            return redirect('message/'.$user->username)->with('error','Message Not Sent');
        }
   }
   public function delete(\App\Models\Message $message)
   {
        $this->authorize('delete', $message);
        $message->delete();

       return redirect()->back();
   }
}
