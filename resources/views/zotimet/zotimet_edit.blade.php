@extends('layout.index')

@section('search_box')
    @include('expenditures.searchForm')
@stop

@section('content')

@include('expenditures.modalForms')
@include('expenditures.buttons')
{!! Form::model($data,['method'=>'PUT', 'action' => ['ExpenditureController@azhurozotim', $data->id]]) !!}

<br>  <p>Azhuro Zotim </p><br>

     {!! csrf_field() !!}


     @include('zotimet.zotimet_form')

    {!! Form::close()!!}

@include('spendingtypes.subform')


@stop
