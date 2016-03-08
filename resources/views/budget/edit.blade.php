@extends('layout.index')

@section('search_box')
    @include('budget.searchForm')
@stop

@section('content')



@include('budget.buttons')

{!! Form::model($data,['method'=>'PATCH','action' => ['BudgetController@update', $data->id]]) !!}

  <br>  <p>Azhuro Buxhetin </p><br>
     {!! csrf_field() !!}

      @include('budget.form')
      <div class="form-group">
          {!! Form::submit('Ruaje',['class' => 'btn btn-primary form-control'])!!}
      </div>

     {!! Form::close()!!}

    <div class="form-group" style="width:400px;">
      @include('errors.error_handler')
      @include('partials.flash')
    </div>






@stop
