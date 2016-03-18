@extends('layout.index')

@section('search_box')
    @include('roles.searchForm')
@stop

@section('content')



@include('roles.buttons')

{!! Form::model($data,['method'=>'PATCH','action' => ['RoleController@update', $data->id]]) !!}

  <br>  <p>Azhuro Furnitorin </p><br>
     {!! csrf_field() !!}

      @include('roles.form')

    {!! Form::close()!!}







@stop
