@extends('layout.index')

@section('search_box')
  @include('expenditures.searchForm')
@stop

@section('content')



@include('expenditures.buttons')
      <div class="well well-lg" >  <p>Pershkrimi: {!! $data->description !!}</p></div>

      <div class="well well-lg"  style="line-height:25px;">
        <p>Drejtoria për: {!! $data->Department->department !!}</p>

        <p><strong>Data e shpenzimit: {!! $data->expenditure_date !!}</strong> </p>

        <p>Regjistruar me: {!! $data->created_at !!}</p>

        <p>Numri fatures: {!! $data->invoice_number !!}</p>

        <p>Lloji i shpenzimit: {!! $data->Spendingtype->spendingtype !!}</p>

        <p>Kategoria e shpenzimit: {!! $data->SpendingCategory->spending_category !!}</p>

        <p>Vlera: {!! $data->value !!} EUR</p>

        <p>Furnitori: {!! $data->supplier->supplier !!}</p>

        <p>Drejtoria: {!! $data->department->department !!}</p>
        <p>Nen Buxheti: {!! $data->sub_budget->sub_budget !!}</p>

        <p>Paguar:
            @if($data->paid==1)
              PO
              <p>Eshte financuar nga: {!! $data->payment_source->payment_source !!}</p>
              <p>Data e pageses: {!! $data->payment_date !!}</p>
              <p>Vlera e pageses: {!! $data->paid_value !!} EUR</p>
            @elseif($data->paid==2)
              JO
            @else
              Pjeserisht:
              <p>Burimi: {!! $data->payment_source->payment_source !!}</p>
              <p>Data e pageses: {!! $data->payment_date !!}</p>
                <p>Data e pageses se borxhit: {!! $data->dept_paid_date !!}</p>
              <p>Vlera e pageses: {!! $data->paid_value !!} EUR</p>
            @endif</p>
        <p>Borxhi: {!! $data->value - $data->paid_value !!} EUR</p>







</div>



@stop
