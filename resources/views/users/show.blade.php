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
        <p>Drejtoria:  {!! $data->department_id !!}</p>
        <p>Roli:  {!! $data->role_id !!}</p>

      </div>
@stop
