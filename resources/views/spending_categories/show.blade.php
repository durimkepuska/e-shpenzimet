@extends('layout.index')

@section('search_box')
  @include('spending_categories.searchForm')
@stop

@section('content')



@include('spending_categories.buttons')
      <div class="well well-lg">  <p>Furnitori: {!! $data->spending_category !!}</p></div>

      <div class="well well-lg">

        <p>ID: {!! $data->id !!}</strong> </p>










</div>



@stop
