@extends('layout.index')

@section('search_box')
  @include('users.searchForm')
@stop

@section('content')



@include('users.buttons')
      <div class="well well-lg">  <p>Emri: {!! $data->name !!}</p></div>

      <div class="well well-lg">

        <p>ID: {!! $data->id !!}</strong> </p>
        <p>Email: {!! $data->email !!}</strong> </p>
        <p>Drejtoria:  {!! Auth::user()->find(Auth::user()->department_id)->Department->department !!}</p>

      </div>
@stop
