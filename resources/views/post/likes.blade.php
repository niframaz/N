@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ url()->previous() }}">Go Back</a>
    <h1>Liked by</h1>
    @foreach($likes as $like)
        <a href="/{{$like->username}}">{{$like->name}}</a><br>
    @endforeach
    {{$likes->links()}}
</div>
@endsection
