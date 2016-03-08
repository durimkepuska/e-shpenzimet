@extends('layout.index')

@section('search_box')
    @include('payment_sources.searchForm')
@stop

@section('content')

@include('payment_sources.buttons')

{!! Form::model($data,['method'=>'PATCH','action' => ['PaymentsourceController@update', $data->id]]) !!}

  <br>  <p>Azhuro Furnitorin </p><br>
     {!! csrf_field() !!}

      @include('payment_sources.form')

    {!! Form::close()!!}
    <div class="form-group" style="width:400px;">
      @include('errors.error_handler')
      @include('partials.flash')
    </div>

@stop
