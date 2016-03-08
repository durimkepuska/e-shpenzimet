@extends('layout.index')

@section('search_box')
  @include('suppliers.searchForm')
@stop

@section('content')



@include('suppliers.buttons')
      <div class="well well-lg">  <p>Furnitori: {!! $data->supplier !!}</p></div>

      <div class="well well-lg" style="line-height:25px;">

        <p>Adresa: {!! $data->address !!}</strong> </p>
        <p>Tel: {!! $data->telephone !!}</strong> </p>
        <p>Numri fiskal: {!! $data->fiscal_number !!}</strong> </p>
        <p>Qyteti: {!! $data->city !!}</strong> </p>
        <p>Shteti: {!! $data->country !!}</strong> </p>
        <p>Kontakti: {!! $data->contact_person !!}</strong> </p>
        <p>Latitude: {!! $data->lat !!}</strong> </p>
        <p>Longitude: {!! $data->lon !!}</strong> </p>










</div>



@stop
