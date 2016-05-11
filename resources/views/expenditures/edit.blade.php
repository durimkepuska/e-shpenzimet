@extends('layout.index')

@section('search_box')
    @include('expenditures.searchForm')
@stop

@section('content')


  @include('expenditures.modalForms')
@include('expenditures.buttons')

{!! Form::model($data,['method'=>'PATCH','action' => ['ExpenditureController@update', $data->id]]) !!}

  <br>  <p>Azhuro Shpenzim </p><br>
     {!! csrf_field() !!}

      @include('expenditures.form')

    {!! Form::close()!!}
  
@include('spendingtypes.subform')
@include('spending_categories.subform')
@include('spendingtypes.subform')
@include('sub_budget.subform')




@stop
