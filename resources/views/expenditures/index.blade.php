@extends('layout.index')

@section('search_box')

@include('expenditures.searchForm')

@stop

@section('content')

@include('expenditures.buttons')

  <table id="myTable" class="tablesorter table table-hover ">

    <thead>
      <tr>
        <th class="text-left">Fatura</th>
        <th class="text-left">Pershkrimi</th>
        <th class="text-right">Vlera</th>
        <th class="text-right">Paguar</th>
        <th class="text-right">Borxhi</th>
        <th class="text-right">Statusi</th>
        <th class="text-right"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $datas)
      <tr>
        <td class="text-left">{!! substr($datas->invoice_number, 0, 20) !!}</td>
        <td class="text-left"><a href="{!! action('ExpenditureController@show', [$datas->id]) !!}">{!! substr($datas->description, 0, 20) !!}... </a></td>
        <td class="text-right">{!! number_format($datas->value,2); !!}</td>
        <td class="text-right">{!! number_format($datas->paid_value,2) !!}</td>
        <td class="text-right">{!! number_format($datas->value - $datas->paid_value,2)  !!}</td>

        <td class="text-right">
          @if($datas->paid==1)
          <button type="button" class="btn btn-success btn-sm">
            <span class="glyphicon glyphicon-ok"></span>  {!! $datas->status->status !!}
          </button>

          @else
          <div class="btn-group">
            <button type="button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span>
              @if($datas->paid==2) {!! $datas->status->status !!} @else {!! $datas->status->status !!} @endif
            </button>
            <button type="button" class="btn btn-danger dropdown-toggle btn-sm" data-toggle="dropdown">
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
              <li>
                <a href="{!! action('ExpenditureController@pay', [$datas->id]) !!}"><span class="glyphicon glyphicon-ok"></span> Paguaj komplet</a><hr>
                <a  data-toggle="modal" data-target="#pjeserisht{!!$datas->id!!}"><span class="glyphicon glyphicon-plus"></span> Paguaj pjeserisht</a>
              </li>
            </ul>
          </div>
              @include('expenditures.subform')
              @endif
        </td>
        <td class="text-right">
          <div class="btn-group">
            <button type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-cog"></span> Options</button>
            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{!! url('expenditures/'.$datas->id.'/edit' ) !!}"><span class="glyphicon glyphicon-edit"></span> Edit</a></li>
              <li><a href="{!! action('ExpenditureController@hidde', [$datas->id]) !!}"><span class="glyphicon glyphicon-eye-close"></span>  Fshihe</a></li>
              <li>
                <a>
                 {!! Form::open(['method' => 'DELETE', 'url' => 'expenditures/'.$datas->id, 'id'=>'myForm']) !!}
                    {!! Form::hidden('id', $datas->id) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                 {!! Form::close() !!}
               </a>
              </li>
            </ul>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
    @include('expenditures.results')

</table>
{!! $data->render() !!}
@stop
