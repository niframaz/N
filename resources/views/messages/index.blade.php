@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($messages as $message)
    {{$message->user->name}} : {{$message->message}} - {{$message->created_at}}
        <br>
    @endforeach 
    {{$messages->links()}}
</div>
@endsection
