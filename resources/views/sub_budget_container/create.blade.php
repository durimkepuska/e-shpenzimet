@extends('layout.index')

@section('search_box')
    @include('sub_budget_container.searchForm')
@stop

@section('content')


@include('sub_budget.buttons')
{!! Form::open(['method'=>'POST','action' => 'SubBudgetContainerController@store']) !!}

     {!! csrf_field() !!}


     @include('sub_budget_container.form')

     <div class="form-group">
         {!! Form::submit('Ruaje',['class' => 'btn btn-primary form-control'])!!}
     </div>

    {!! Form::close()!!}



@stop
