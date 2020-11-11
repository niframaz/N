@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($messages as $message)
    <a href="{{$message->user->username}}">{{$message->user->name}}</a> : {{$message->message}} - <small>{{$message->created_at}}</small>
        <br>
        <form action="/{{$message->id}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
        <br>
    @endforeach 
    {{$messages->links()}}
</div>
@endsection
