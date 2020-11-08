@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/profile/{{$profile->id}}">Go Back</a>
    <h1>Followers</h1>
    @foreach($followers as $follower)
        <a href="/profile/{{$follower->id}}">{{$follower->name}}</a>
    @endforeach
    {{$followers->links()}}
</div>
@endsection
