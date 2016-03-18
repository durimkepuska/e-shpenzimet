@extends('layout.index')

@section('search_box')
    @include('departments.searchForm')
@stop

@section('content')



@include('departments.buttons')

{!! Form::model($data,['method'=>'PATCH','action' => ['DepartmentController@update', $data->id]]) !!}

  <br>  <p>Azhuro Furnitorin </p><br>
     {!! csrf_field() !!}

      @include('departments.form')

    {!! Form::close()!!}
    






@stop
