@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/profile/{{$user->id}}">Go Back</a>
    <h1>Following</h1>
    @foreach($followings as $following)
    <a href="/profile/{{$following->user->id}}">{{$following->user->name}}</a>
    @endforeach
    {{$followings->links()}}
</div>
@endsection
