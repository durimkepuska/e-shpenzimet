@extends('auth_layout.template')

@section('form')
<div style="text-align:center;">
	<img src="{!! URL::asset('web/images/logo.png') !!}" alt="Logo">
</div><br>
<div class="container" >

    {!! Form::open(['url'=>'/auth/login']) !!}
     {!! csrf_field() !!}
        <div class="form-group" style="width:320px;">
             {!! Form::label('email','Email:') !!}
             {!! Form::text('email', null, ['class' => 'form-control', 'require' => 'require'])!!}
        </div>
        <div class="form-group" style="width:320px;">
              {!! Form::label('password','Fjalëkalimi:') !!}<br>
              {!! Form::text('password', null, ['class' => 'form-control'])!!}
        </div>
        <div class="form-group">
          <p>{!! Form::checkbox('remember') !!} Më mbajë në mend (30 ditë)</p>
        </div>
        <div class="form-group" style="width:80px;">
             {!! Form::submit('Kyçu',['class' => 'btn btn-default form-control'])!!}
        </div>

    {!! Form::close()!!}
     <a href="{!!url('password/email')!!}">Kam harruar fjalëkalimin!</a>
</div>
<div class="form-group" style="width:400px;">
@include('errors.error_handler')
@include('partials.flash')
</div>
@stop
