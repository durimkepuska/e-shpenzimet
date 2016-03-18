@extends('auth_layout.template')

@section('form')

<div class="container">
  <h4>Shkruani email-in dhe fjalëkalimin e ri.</h4>
<form method="POST" {!! url('password/reset') !!}>
    {!! csrf_field() !!}
    <input type="hidden" name="token" value="{{ $token }}">
    <div>
        Email
        <input type="email" style="width:400px;" name="email" class="form-control" value="{{ old('email') }}"><br>
    </div>
    <div>
        Fjalëkalimi i ri
        <input type="password"  style="width:400px;" class="form-control" name="password"><br>
    </div>
    <div>
        Përsërite fjalëkalimin e ri
        <input type="password" style="width:400px;" class="form-control" name="password_confirmation"><br>
    </div>
    <div>
        <button type="submit" style="width:150px;" class="btn btn-default form-control">
            Regjistro
        </button>
    </div>
</form>

</div>

@stop
