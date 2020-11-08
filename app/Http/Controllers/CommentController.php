<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(\App\Models\Post $post, \App\Models\User $user)
    {

        $data = request()->validate([
            'comment' => 'required'
        ]);

        $comment = new Comment;
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $post->id;
        $comment->comment = $data['comment'];
        $comment->save();

        return redirect('post/'.$post->id);

    }

    public function delete(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect('post/'.$comment->post->id);

    }
}
