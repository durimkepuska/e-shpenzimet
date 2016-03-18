@extends('layout.index')

@section('search_box')
    @include('payment_sources.searchForm')
@stop

@section('content')


@include('payment_sources.buttons')
{!! Form::open(['method'=>'POST','action' => 'PaymentsourceController@store']) !!}

     {!! csrf_field() !!}


     @include('payment_sources.form')

    {!! Form::close()!!}

  

@stop
