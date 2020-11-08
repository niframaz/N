@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/profile/{{$user->id}}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PATCH')

        <div class="row">
            <div class="col-8 offset-2">

                <div class="row">
                    <h1>Edit Profile</h1>
                </div>

                <div class="form-group row">
                    <label for="about" class="col-md-4 col-form-label">About</label>

                        <input id="about" 
                        type="textarea" 
                        class="form-control @error('about') is-invalid @enderror"
                        name="about" 
                        value="{{ old('about') ?? $user->profile->about}}" 
                        autocomplete="about" autofocus>

                        @error('about')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="row">
                    <label for="user_image" class="col-md-4 col-form-label">Profile Image</label>
                    
                    <input type="file", class="form-control-file" id="image" name="user_image">
                    
                    @error('user_image')
                        <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="row pt-4">
                    <button class="btn btn-primary">Save Profile</button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
