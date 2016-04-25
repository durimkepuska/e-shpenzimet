@extends('layout.index')

@section('search_box')
  @include('expenditures.searchForm')
@stop

@section('content')



@include('expenditures.buttons')
      <div class="well well-lg" >  <p>Pershkrimi: {!! $data->description !!}</p></div>


<table class="table table-hover">
    <thead>
      <tr style="background-color:gray;">
        <th>Titulli</th>
        <th>Gjendja</th>

      </tr>
    </thead>
    <tbody>

      <tr>
        <td>Drejtoria:</td>
        <td>{!! $data->Department->department !!}</td>
      </tr>
      <tr>
        <td>Kategoria e shpenzimit:</td>
        <td>{!! $data->Spendingtype->spendingtype !!}</td>
      </tr>
      <tr>
        <td>nenKategoria e shpenzimit:</td>
        <td>{!! $data->SpendingCategory->spending_category !!}</td>
      </tr>
      <tr>
        <td>Furnitori:</td>
        <td>{!! $data->supplier->supplier !!}</td>
      </tr>
      <tr>
        <td>Numri fatures:</td>
        <td>{!! $data->invoice_number !!}</td>
      </tr>
      <tr>
        <td>Vlera e fatures: </td>
        <td>{!! $data->value !!} EUR</td>
      </tr>
      @if($data->paid==1)
          <tr style="background-color:green;">
            <td>Paguar:</td>
            <td>PO</td>
          </tr>
          <tr>
            <td>Vlera e pageses:</td>
            <td>{!! $data->paid_value !!} EUR</td>
          </tr>
          <tr>
            <td>Eshte financuar nga:</td>
            <td>{!! $data->payment_source->payment_source !!}</td>
          </tr>
          <tr>
            <td>Data e pageses:</td>
            <td>{!! $data->payment_date !!}</td>
          </tr>


        @elseif($data->paid==2)
        <tr style="background-color:red;">
          <td>Paguar</td>
          <td>JO</td>
        </tr>
        <tr>
          <td>Data e pageses se borxhit:</td>
          <td>{!! $data->dept_paid_date !!} </td>
        </tr>
        @else

        <tr style="background-color:green;">
          <td>Paguar</td>
          <td>Pjeserishte</td>
        </tr>
        <tr>
          <td>Vlera e pageses:</td>
          <td>{!!  $data->paid_value !!} EUR</td>
        </tr>
        <tr>
          <td>Data e pageses se borxhit:</td>
          <td>{!! $data->dept_paid_date !!} </td>
        </tr>
        @endif
        <tr>
          <td>Borxhi:</td>
          <td>{!! $data->value - $data->paid_value !!} EUR</td>
        </tr>

      <tr>
        <td>Data e shpenzimit:</td>
        <td>{!! $data->expenditure_date !!}</td>
      </tr>
      <tr>
        <td>Data e regjistrimit:</td>
        <td>{!! $data->created_at !!}</td>
      </tr>
      <tr>
        <td>Nen Buxheti:</td>
        <td>{!! $data->sub_budget !!}</td>
      </tr>







    </tbody>
  </table>




@stop
