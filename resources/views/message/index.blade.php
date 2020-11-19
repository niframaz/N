@extends('layouts.app')

@section('content')
<div class="container">
    @forelse($messages as $message)
    <a href="{{$message->user->username}}">{{$message->user->name}}</a> : {{$message->message}} - <small>{{$message->created_at}}</small>
        <br>
        <form action="/{{$message->id}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
        <br>
        @empty
            <p>You have no messages</p>
    @endforelse
    {{$messages->links()}}
</div>
@endsection
