@extends('layout.index')

@section('search_box')
    @include('departments.searchForm')
@stop

@section('content')


@include('departments.buttons')
{!! Form::open(['method'=>'POST','action' => 'DepartmentController@store']) !!}

     {!! csrf_field() !!}


     @include('departments.form')

    {!! Form::close()!!}
  

@stop
