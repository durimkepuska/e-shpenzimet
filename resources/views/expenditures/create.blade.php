@extends('layout.index')

@section('search_box')
    @include('expenditures.searchForm')
@stop

@section('content')

@include('expenditures.modalForms')
@include('expenditures.buttons')
{!! Form::open(['method'=>'POST','action' => 'ExpenditureController@store']) !!}

     {!! csrf_field() !!}


     @include('expenditures.form')

    {!! Form::close()!!}

@include('spending_categories.subform')
@include('spendingtypes.subform')
@include('sub_budget.subform')


@stop
