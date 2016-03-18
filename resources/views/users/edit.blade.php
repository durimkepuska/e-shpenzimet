@extends('layout.index')

@section('search_box')
    @include('users.searchForm')
@stop

@section('content')



@include('users.buttons')

{!! Form::model($data,['method'=>'PATCH','action' => ['UserController@update', $data->id]]) !!}

  <br>  <p>Azhuro Shfrytezuesin </p><br>
     {!! csrf_field() !!}

      @include('users.form')

    {!! Form::close()!!}

@stop
