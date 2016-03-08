@extends('layout.index')

@section('search_box')
  @include('users.searchForm')
@stop

@section('content')



@include('users.buttons')
      <div class="well well-lg">  <p>Furnitori: {!! $data->name !!}</p></div>

      <div class="well well-lg">

        <p>ID: {!! $data->id !!}</strong> </p>










</div>



@stop
