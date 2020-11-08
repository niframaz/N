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
       return view('messages.create', compact('user'));
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

            return redirect('message/'.$user->id.'/create')->with('success','Message Sent');
        }
        else
        {
            return redirect('message/'.$user->id.'/create')->with('error','Message Not Sent');
        }

   }
}
