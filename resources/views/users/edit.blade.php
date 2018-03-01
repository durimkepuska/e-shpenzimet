@extends('layout.index')

@section('search_box')
    @include('users.searchForm')
@stop

@section('content')

@include('users.buttons')

{!! Form::model($data,['method'=>'PATCH','action' => ['UserController@update', $data->id]]) !!}

  <br>  <p>Azhuro emrin ose fjalekalimin e shfrytezuesit </p><br>
     {!! csrf_field() !!}

      
	<div class="form-group col-md-4" >
	   {!! Form::label('name', 'Shfrytezuesi:', array('class' => 'mylabel')) !!}
	    {!! Form::text('name', null, ['class' => 'form-control', 'require' => 'require','placeholder'=>'Shfrytezuesi'])!!}
	    <br>
	    {!! Form::label('department_id', 'Drejtoria:', array('class' => 'mylabel')) !!}
        {!! Form::select('department_id', $departments , null,  ['class' => 'form-control']) !!}
        <br>	
	    {!! Form::label('fjalekalimi', 'Fjalëkalimi:', array('class' => 'mylabel')) !!}
	    {!! Form::text('fjalekalimi', null, ['class' => 'form-control', 'require' => 'require','placeholder'=>'Fjalëkalimi i ri?'])!!}
		<br>

	    {!! Form::submit('Ruaje',['class' => 'btn btn-primary form-control'])!!}
	</div>


    {!! Form::close()!!}

@stop
