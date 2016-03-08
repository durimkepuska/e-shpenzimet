@extends('layout.index')

@section('search_box')
  @include('roles.searchForm')
@stop

@section('content')



@include('roles.buttons')
      <div class="well well-lg">  <p>Furnitori: {!! $data->role !!}</p></div>

      <div class="well well-lg">

        <p>ID: {!! $data->id !!}</strong> </p>










</div>



@stop
