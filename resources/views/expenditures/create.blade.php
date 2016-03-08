@extends('layout.index')

@section('search_box')
    @include('expenditures.searchForm')
@stop

@section('content')

@include('expenditures.modalForms')
@include('expenditures.buttons')
{!! Form::open(['method'=>'POST','action' => 'ExpenditureController@store']) !!}

     {!! csrf_field() !!}


     @include('expenditures.form')

    {!! Form::close()!!}
    <div class="form-group" style="width:400px;">
      @include('errors.error_handler')
      @include('partials.flash')
    </div>

@stop
