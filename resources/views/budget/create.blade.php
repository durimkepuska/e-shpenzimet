@extends('layout.index')

@section('search_box')
    @include('budget.searchForm')
@stop

@section('content')


@include('budget.buttons')
{!! Form::open(['method'=>'POST','action' => 'BudgetController@store']) !!}

     {!! csrf_field() !!}


     @include('budget.form')

     <div class="form-group">
         {!! Form::submit('Ruaje',['class' => 'btn btn-primary form-control'])!!}
     </div>

    {!! Form::close()!!}

  

@stop
