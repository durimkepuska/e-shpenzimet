@extends('layout.index')

@section('search_box')
    @include('sub_budget.searchForm')
@stop

@section('content')



@include('sub_budget.buttons')

{!! Form::model($data,['method'=>'PATCH','action' => ['SubBudgetController@update', $data->id]]) !!}

  <br>  <p>Azhuro nën buxhetin </p><br>
     {!! csrf_field() !!}

      @include('sub_budget.form')


     {!! Form::close()!!}







@stop
