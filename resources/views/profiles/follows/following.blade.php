@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/{{$user->username}}">Go Back</a>
    <h1>Following</h1>
    @foreach($followings as $following)
    <a href="/{{$following->user->username}}">{{$following->user->name}}</a>
    <form action="/follow/{{$following->id}}" method="post">
        @csrf
        <button class="btn btn-primary">{{auth()->user()->following->contains($following->id) ? 'Unfollow' : 'Follow'}}</button>
    </form>
    <br>
    @endforeach
    {{$followings->links()}}
</div>
@endsection
