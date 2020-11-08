@foreach($errors->all() as $error)
<div class="alert alert_danger">
    {{$error}}
</div>
@endforeach

@if(session('success'))
    <div class="alert alert_success">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert_danger">
        {{session('error')}}
    </div>
@endif