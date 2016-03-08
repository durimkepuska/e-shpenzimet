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
    <div class="form-group" style="width:400px;">
      @include('errors.error_handler')
      @include('partials.flash')
    </div>

@stop
