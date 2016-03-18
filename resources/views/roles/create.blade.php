@extends('layout.index')

@section('search_box')
    @include('roles.searchForm')
@stop

@section('content')


@include('roles.buttons')
{!! Form::open(['method'=>'POST','action' => 'RoleController@store']) !!}

     {!! csrf_field() !!}


     @include('roles.form')

    {!! Form::close()!!}


@stop
