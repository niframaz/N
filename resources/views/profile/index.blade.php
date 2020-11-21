@extends('layouts.app')

@section('content')
<div class="container">
    <img src="/storage/{{$user->profile->user_image}}" height="100">
    <br>
    {{$user->name}}
    <br>
    Bio: {{$user->profile->about}}
    <br>
    @cannot('update', $user->profile)
    <a href="/message/{{$user->username}}">Message</a>
    <br>
        <form action="/follow/{{$user->id}}" method="post">
            @csrf
            <follow-button class="btn btn-primary py-1 h4" user-id = "{{$user->id}}" follows="{{$follows}}"></follow-button>
        </form>
    @endcannot
    <br>
    @can('update', $user->profile)
        <a href="/post/create">Add New Post</a>
        <br>
        <a href="{{route('profile.edit')}}">Edit Profile</a>
    @endcan
    <br>
    {{$user->posts->count()}} posts <br>
    <a href="{{route('followers',$user->username)}}">{{$user->profile->followers->count()}} followers </a><br>
    <a href="/{{$user->username}}/following">{{$user->following->count()}} following</a> <br>

    @foreach($posts as $post)
        <a href="/post/{{$post->id}}">
            <img height="350"src="/storage/{{$post->image}}">
        </a>
            <div>{{$post->caption}}</div>
            <form action="/like/{{$post->id}}" method="post">
                @csrf
                <button class="btn btn-primary">{{$like ? 'Unlike' : 'Like'}}</button>
            </form>
            {{$post->like->count()}} <a href="/post/{{$post->id}}/likes">likes</a> {{$post->comments()->count()}} <a href="/post/{{$post->id}}"> Comments</a>
    
            <br>
    @endforeach
    {{$posts->links()}}

</div>
@endsection
