@extends('auth_layout.template')

@section('form')

<div class="container">

    {!! Form::open(['url'=>'password/email']) !!}

     {!! csrf_field() !!}

        <div class="form-group" style="width:400px;">
             {!! Form::label('email','email:') !!}
             {!! Form::text('email', old('email') , ['class' => 'form-control', 'require' => 'require'])!!}
        </div>
        <div class="form-group" style="width:80px;">
             {!! Form::submit('Send',['class' => 'btn btn-default form-control'])!!}
         </div>

    {!! Form::close()!!}


</div>
<div class="form-group" style="width:400px;">
@include('errors.error_handler')
@include('partials.flash')
</div>
@stop

