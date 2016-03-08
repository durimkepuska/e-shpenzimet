@extends('auth_layout.template')

@section('form')

<div class="container">
{!! Form::open(['method'=>'POST','action' => 'Auth\AuthController@postRregister']) !!}

     {!! csrf_field() !!}
        <div class="form-group" style="width:400px;">
             {!! Form::label('name','Full name:') !!}
             {!! Form::text('name', null, ['class' => 'form-control', 'require' => 'require'])!!}
        </div>
        <div class="form-group" style="width:400px;">
              {!! Form::label('email','email:') !!}
              {!! Form::text('email', null, ['class' => 'form-control'])!!}
        </div>
        <div class="form-group" style="width:350px;">
             {!! Form::label('department_id','Department:') !!}
             {!! Form::select('department_id', $department_name , null,  ['class' => 'form-control'] )!!}
        </div>
        <div class="form-group" style="width:350px;">
              {!! Form::label('role_id','Role:') !!}
              {!! Form::select('role_id', $role_name , null,  ['class' => 'form-control'] )!!}
        </div>
        <div class="form-group" style="width:350px;">
              {!! Form::label('password','Password:') !!}<br>
              {!! Form::password('password', null, ['class' => 'form-control'])!!}
        </div>
        <div class="form-group" style="width:350px;">
              {!! Form::label('password_confirmation','Repeat password:') !!}<br>
              {!! Form::password('password_confirmation', null, ['class' => 'form-control'])!!}
        </div>

        <div class="form-group" style="width:80px;">
             {!! Form::submit('Register',['class' => 'btn btn-default form-control'])!!}
        </div>


    {!! Form::close()!!}
</div>
<div class="form-group" style="width:400px;">
    @include('errors.error_handler')
    @include('partials.flash')
</div>

@stop
