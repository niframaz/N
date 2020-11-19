@extends('layouts.app')

@section('content')
<div class="container">
    @forelse($posts as $post)
    <a href="/post/{{$post->id}}">
        <img height="350"src="/storage/{{$post->image}}">
    </a>
    <div>
        <form action="/like/{{$post->id}}" method="post">
            @csrf
            <button class="btn btn-primary">{{auth()->user()->like->contains($post->id) ? 'Unlike' : 'Like'}}</button>
        </form>
    {{$post->like->count()}} <a href="/post/{{$post->id}}/likes">likes</a> {{$post->comments()->count()}} <a href="/post/{{$post->id}}"> Comments</a> {{$post->caption}} posted by <a href="/{{$post->user->username}}">{{$post->user->name}}</a>
    </div>
    @empty
    <p>Follow someone to see posts</p>
@endforelse
{{$posts->links()}}
</div>
@endsection
