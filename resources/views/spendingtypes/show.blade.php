@extends('layout.index')

@section('search_box')
  @include('spendingtypes.searchForm')
@stop

@section('content')



@include('spendingtypes.buttons')
      <div class="well well-lg">  <p>Lloji i shpenzimit: {!! $data->spendingtype !!}</p></div>

      <div class="well well-lg">

        <p>ID: {!! $data->id !!}</strong> </p>

</div>



@stop
