@extends('layout.index')

@section('search_box')
    @include('expenditures.searchForm')
@stop

@section('content')

@include('expenditures.modalForms')
@include('expenditures.buttons')
{!! Form::open(['method'=>'POST','action' => 'ExpenditureController@zotimet_store']) !!}

     {!! csrf_field() !!}


     @include('zotimet.zotimet_form')

    {!! Form::close()!!}

@include('spendingtypes.subform')


@stop
