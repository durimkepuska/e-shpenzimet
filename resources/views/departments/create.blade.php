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
    <div class="form-group" style="width:400px;">
      @include('errors.error_handler')
      @include('partials.flash')
    </div>

@stop
