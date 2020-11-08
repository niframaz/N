@extends('layouts.app')

@section('content')
<div class="container">
    @include('inc.messages')
    <h3>Message to {{$user->name}}</h3>
    <form action="/message/{{$user->id}}" method="post">
        @csrf

        <input id="message"
        type="textarea" 
        class="form-control @error('message') is-invalid @enderror"
        name="message" 
        value="{{ old('message') }}" 
        autocomplete="message" autofocus>

        @error('message')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <button class="btn btn-primary">Message</button>
    </form>
</div>
@endsection
