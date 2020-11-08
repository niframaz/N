@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ url()->previous() }}">Go Back</a>
    <h1>Likes</h1>
    @foreach($likes as $like)
        <a href="/profile/{{$like->id}}">{{$like->name}}</a><br>
    @endforeach
    {{$likes->links()}}
</div>
@endsection
