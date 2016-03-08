@extends('layout.index')

@section('search_box')
    @include('spendingtypes.searchForm')
@stop

@section('content')



@include('spendingtypes.buttons')

{!! Form::model($data,['method'=>'PATCH','action' => ['SpendingtypeController@update', $data->id]]) !!}

  <br>  <p>Azhuro Llojet e shpenzimeve </p><br>
     {!! csrf_field() !!}

      @include('spendingtypes.form')

    {!! Form::close()!!}
    <div class="form-group" style="width:400px;">
      @include('errors.error_handler')
      @include('partials.flash')
    </div>






@stop
