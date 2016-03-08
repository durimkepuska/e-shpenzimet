@extends('auth_layout.template')

@section('form')

<div class="container">

<form method="POST" {!! url('password/reset') !!}>
    {!! csrf_field() !!}
    <input type="hidden" name="token" value="{{ $token }}">



    <div>
        Email
        <input type="email" style="width:400px;" name="email" class="form-control" value="{{ old('email') }}"><br>
    </div>

    <div>
        Password
        <input type="password"  style="width:400px;" class="form-control" name="password"><br>
    </div>

    <div>
        Confirm Password
        <input type="password" style="width:400px;" class="form-control" name="password_confirmation"><br>
    </div>

    <div>
        <button type="submit" style="width:150px;" class="btn btn-default form-control">
            Reset Password
        </button>
    </div>
</form>

</div>
<div class="form-group" style="width:400px;">
@include('errors.error_handler')
@include('partials.flash')
</div>
@stop
