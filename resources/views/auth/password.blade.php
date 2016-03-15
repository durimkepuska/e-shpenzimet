@extends('auth_layout.template')

@section('form')
<div style="text-align:center;">
	<img src="{!! URL::asset('web/images/logo.png') !!}" alt="Logo">
</div><br>
<div class="container">
<h4>Shkruani email-in në të cilin dëshironi t'ju dërgohet linku për ndryshimin e fjalëkalimit.<br>
Pas klikimit të butonit "Dërgo" kontrolloni email-in tuaj (Prisni deri në 3 min).<br>
Klikoni në linkun e dërguar në email-in tuaj për ta ndryshuar fjalëkalimin.</h4>
    {!! Form::open(['url'=>'password/email']) !!}

     {!! csrf_field() !!}

        <div class="form-group" style="width:400px;">
             {!! Form::label('email','email:') !!}
             {!! Form::text('email', old('email') , ['class' => 'form-control', 'require' => 'require',''])!!}
        </div>
        <div class="form-group" style="width:80px;">
             {!! Form::submit('Dërgo',['class' => 'btn btn-default form-control'])!!}
         </div>

    {!! Form::close()!!}


</div>
<div class="form-group" style="width:400px;">
@include('errors.error_handler')
@include('partials.flash')
</div>
@stop
