@extends('layout.index')

@section('search_box')
    @include('users.searchForm')
@stop

@section('content')


@include('users.buttons')
{!! Form::open(['method'=>'POST','action' => 'UserController@store']) !!}

     {!! csrf_field() !!}


     @include('users.form')

    {!! Form::close()!!}

@stop
