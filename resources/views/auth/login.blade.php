@extends('auth_layout.template')

@section('form')

<div class="container">

    {!! Form::open(['url'=>'/auth/login']) !!}
     {!! csrf_field() !!}
        <div class="form-group" style="width:400px;">
             {!! Form::label('email','email:') !!}
             {!! Form::text('email', null, ['class' => 'form-control', 'require' => 'require'])!!}
        </div>
        <div class="form-group" style="width:300px;">
              {!! Form::label('password','Password:') !!}<br>
              {!! Form::password('password', null, ['class' => 'form-control'])!!}
        </div>
        <div class="form-group">

               <p>{!! Form::checkbox('remember') !!} Remember me </p>
        </div>
        <div class="form-group" style="width:80px;">
             {!! Form::submit('Login',['class' => 'btn btn-default form-control'])!!}
        </div>

    {!! Form::close()!!}
     <a href="{!!url('password/email')!!}">Forgot password</a>

</div>
<div class="form-group" style="width:400px;">
@include('errors.error_handler')
@include('partials.flash')
</div>
@stop
