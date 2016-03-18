@extends('auth_layout.template')

@section('form')

<div class="container">
{!! Form::open(['method'=>'POST','action' => 'Auth\AuthController@postRregister']) !!}

     {!! csrf_field() !!}
        <div class="form-group" style="width:320px;">
             {!! Form::label('name','Emri dhe Mbiemri:') !!}
             {!! Form::text('name', null, ['class' => 'form-control', 'require' => 'require'])!!}
        </div>
        <div class="form-group" style="width:320px;">
              {!! Form::label('email','email:') !!}
              {!! Form::text('email', null, ['class' => 'form-control'])!!}
        </div>
        <div class="form-group" style="width:320px;">
             {!! Form::label('department_id','Drejtoria:') !!}
             {!! Form::select('department_id', $department_name , null,  ['class' => 'form-control'] )!!}
        </div>
        <div class="form-group" style="width:320px;">
              {!! Form::label('role_id','Roli:') !!}
              {!! Form::select('role_id', $role_name , null,  ['class' => 'form-control'] )!!}
        </div>
        <div class="form-group" style="width:320px;">
              {!! Form::label('password','Fjalëkalimi:') !!}<br>
              {!! Form::password('password', null, ['class' => 'form-control'])!!}
        </div>
        <div class="form-group" style="width:320px;">
              {!! Form::label('password_confirmation','Konfirmo Fjalëkalimin:') !!}<br>
              {!! Form::password('password_confirmation', null, ['class' => 'form-control'])!!}
        </div>

        <div class="form-group" style="width:80px;">
             {!! Form::submit('Regjistro',['class' => 'btn btn-default form-control'])!!}
        </div>


    {!! Form::close()!!}
</div>


@stop
