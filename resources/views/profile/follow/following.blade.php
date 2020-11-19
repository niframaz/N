@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/{{$user->username}}">Go Back</a>
    <h1>Following</h1>
    @foreach($followings as $following)
    <a href="/{{$following->user->username}}">{{$following->user->name}}</a>
    <br>
    @endforeach
    {{$followings->links()}}
</div>
@endsection
