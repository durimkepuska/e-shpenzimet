@extends('layout.index')

@section('search_box')
  @include('expenditures.searchForm')
@stop

@section('content')



@include('expenditures.buttons')
      <div class="well well-lg" >  <p>Pershkrimi: {!! $data->description !!}</p></div>

      <div class="well well-lg"  style="line-height:25px;">
        <p>Drejtoria për: {!! $data->Department->department !!}</p>
          <p>Mjetet jane financuar nga: {!! $data->payment_source->payment_source !!} </p>
        <p><strong>Data e planifikuar: {!! $data->expenditure_date !!}</strong> </p>

        <p>Regjistruar me: {!! $data->created_at !!}</p>
        <p>Lloji i shpenzimit: {!! $data->Spendingtype !!}</p>




        <p>Vlera: {!! $data->paid_value !!} EUR</p>



        <p>Statusi: Zotim i mjeteve</p>







</div>



@stop
