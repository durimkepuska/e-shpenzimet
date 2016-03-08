@extends('layout.index')

@section('search_box')
    @include('suppliers.searchForm')
@stop

@section('content')


@include('suppliers.buttons')
{!! Form::open(['method'=>'POST','action' => 'SupplierController@store']) !!}

     {!! csrf_field() !!}


     @include('suppliers.form')



    {!! Form::close()!!}

    <div class="form-group" style="width:400px;">
      @include('errors.error_handler')
      
    </div>

@stop
