@extends('layout.index')

@section('search_box')
    @include('spending_categories.searchForm')
@stop

@section('content')



@include('spending_categories.buttons')

{!! Form::model($data,['method'=>'PATCH','action' => ['SpendingCategoryController@update', $data->id]]) !!}

  <br>  <p>Azhuro Furnitorin </p><br>
     {!! csrf_field() !!}

      @include('spending_categories.form')

    {!! Form::close()!!}
    <div class="form-group" style="width:400px;">
      @include('errors.error_handler')
      @include('partials.flash')
    </div>






@stop
