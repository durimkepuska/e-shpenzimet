@extends('layout.index')

@section('search_box')
  @include('payment_sources.searchForm')
@stop

@section('content')



@include('payment_sources.buttons')
      <div class="well well-lg">  <p>Furnitori: {!! $data->payment_source !!}</p></div>

      <div class="well well-lg">

        <p>ID: {!! $data->id !!}</strong> </p>










</div>



@stop
