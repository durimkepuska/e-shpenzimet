@extends('layout.index')

@section('search_box')
  @include('departments.searchForm')
@stop

@section('content')



@include('departments.buttons')
      <div class="well well-lg">  <p>Furnitori: {!! $data->department !!}</p></div>

      <div class="well well-lg">

        <p>ID: {!! $data->id !!}</strong> </p>










</div>



@stop
