@extends('layout.index')

@section('search_box')
    @include('sub_budget_container.searchForm')
@stop

@section('content')



@include('sub_budget.buttons')

{!! Form::model($data,['method'=>'PATCH','action' => ['SubBudgetContainerController@update', $data->id]]) !!}

  <br>  <p>Azhuro  nen buxhetin </p><br>
     {!! csrf_field() !!}

      @include('sub_budget_container.form')
      <div class="form-group">
          {!! Form::submit('Ruaje',['class' => 'btn btn-primary form-control'])!!}
      </div>

     {!! Form::close()!!}








@stop
