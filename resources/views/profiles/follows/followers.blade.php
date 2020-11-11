@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/{{$user->username}}">Go Back</a>
    <h1>Followers</h1>
    @foreach($followers as $follower)
        <a href="/{{$follower->username}}">{{$follower->name}}</a>
        <form action="/follow/{{$follower->id}}" method="post">
            @csrf
            <button class="btn btn-primary">{{auth()->user()->following->contains($follower->id) ? 'Unfollow' : 'Follow'}}</button>
        </form>
        <br>
    @endforeach
    {{$followers->links()}}
</div>
@endsection
