@extends('layouts.app')

@section('content')
<div class="container">
    <img src="/storage/{{$post->image}}" class="w-50">
    <br>
    {{$post->caption}} <br> posted at {{$post->created_at}} by <a href="/profile/{{$post->user->id}}">{{$post->user->name}}</a>
    <br>
    @can('update', $post)
        <a href="/post/{{$post->id}}/edit">Edit Caption</a>

        <form action="/post/{{$post->id}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete Post</button>
        </form>
    @endcan
    <br>

    <form action="/like/{{$post->id}}" method="post">
        @csrf
        <button class="btn btn-primary">{{$like ? 'Unlike' : 'Like'}}</button>
    </form>
    <br>

    <form action="/post/{{$post->id}}/{{$post->user->id}}/comment" method="post">
        @csrf

        <input id="comment" 
        type="textarea" 
        class="form-control @error('comment') is-invalid @enderror"
        name="comment" 
        value="{{ old('comment') }}" 
        autocomplete="comment" autofocus>

        @error('comment')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <button class="btn btn-primary">Comment</button>
    </form>
    <br>
    
    <a href="/post/{{$post->id}}/likes">{{$post->like->count()}} Likes</a> {{$post->comments()->count()}} Comments
    <br>
    @foreach($comments as $comment)
        {{$comment->comment}} by {{$comment->user->name}}

        @can('delete', $comment)
        <form action="/comment/{{$comment->id}}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
        @endcan
        <br>
    @endforeach
    {{$comments->links()}}
</div>
@endsection
