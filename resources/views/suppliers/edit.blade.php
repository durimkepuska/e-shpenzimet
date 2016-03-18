@extends('layout.index')

@section('search_box')
    @include('suppliers.searchForm')
@stop

@section('content')



@include('suppliers.buttons')

{!! Form::model($data,['method'=>'PATCH','action' => ['SupplierController@update', $data->id]]) !!}

  <br>  <p>Azhuro Furnitorin </p><br>
     {!! csrf_field() !!}

      @include('suppliers.form')


     {!! Form::close()!!}







@stop
