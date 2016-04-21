@extends('layout.index')

@section('search_box')
  @include('sub_budget.searchForm')
@stop

@section('content')



@include('sub_budget.buttons')
      <div class="well well-lg">  <p>Nen buxheti: {!! $data->sub_budget !!}</p></div>












</div>



@stop
