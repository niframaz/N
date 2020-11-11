@extends('layouts.app')

@section('content')
<div class="container">
    @include('inc.messages');
    <a href="/{{$user->username}}">Go Back</a>
    <h3>Message to {{$user->name}}</h3>
    <form action="/message/{{$user->username}}" method="post">
        @csrf

        <textarea id="message"
        class="form-control @error('message') is-invalid @enderror"
        name="message"
        placeholder="Message"
        autofocus>
        </textarea>

        <button class="btn btn-primary">Send</button>
    </form>
</div>
@endsection
