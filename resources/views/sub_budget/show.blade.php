@extends('layout.index')

@section('search_box')
  @include('sub_budget.searchForm')
@stop

@section('content')



@include('sub_budget.buttons')
      <div class="well well-lg">  <p>Furnitori: {!! $data->sub_budget !!}</p></div>

      <div class="well well-lg" style="line-height:25px;">











</div>



@stop
