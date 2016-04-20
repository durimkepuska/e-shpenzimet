@extends('layout.index')

@section('search_box')
    @include('sub_budget.searchForm')
@stop

@section('content')


@include('sub_budget.buttons')
{!! Form::open(['method'=>'POST','action' => 'SubBudgetController@store']) !!}

     {!! csrf_field() !!}


     @include('sub_budget.form')



    {!! Form::close()!!}


@stop
