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

    <div class="form-group" style="width:400px;">
      @include('errors.error_handler')
      @include('partials.flash')
    </div>

@stop
