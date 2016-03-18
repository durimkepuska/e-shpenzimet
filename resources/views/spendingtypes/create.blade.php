@extends('layout.index')

@section('search_box')
    @include('spendingtypes.searchForm')
@stop

@section('content')


@include('spendingtypes.buttons')
{!! Form::open(['method'=>'POST','action' => 'SpendingtypeController@store']) !!}

     {!! csrf_field() !!}


     @include('spendingtypes.form')

    {!! Form::close()!!}


@stop
