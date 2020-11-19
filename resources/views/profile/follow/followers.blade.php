@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/{{$user->username}}">Go Back</a>
    <h1>Followers</h1>
    @foreach($followers as $follower)
        <a href="/{{$follower->username}}">{{$follower->name}}</a>
        <br>
    @endforeach
    {{$followers->links()}}
</div>
@endsection
