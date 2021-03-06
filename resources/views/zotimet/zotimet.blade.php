@extends('layout.index')

@section('search_box')

@include('expenditures.searchForm')

@stop

@section('content')

@include('expenditures.buttons')

  <table id="myTable" class="tablesorter table table-hover ">

    <thead>
      <tr>
      <th class="text-left">Pershkrimi</th>
        <th class="text-right">Vlera</th>
        <th class="text-right">Data</th>

        <th class="text-right">Statusi</th>
        <th class="text-right"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $datas)
      <tr>
        <td class="text-left"><a href="{!! action('ExpenditureController@zotimet_show', [$datas->id]) !!}">{!! substr($datas->description, 0, 25) !!}... </a></td>
        <td class="text-right">{!! number_format($datas->paid_value,2); !!}</td>
        <td class="text-right">{!! $datas->expenditure_date !!}</td>
        <td class="text-right">

          <div class="btn-group">
            <button type="button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-ok"></span>
               Zotim i mjeteve
            </button>

          </div>
              @include('expenditures.subform')

        </td>
        <td class="text-right">
          <div class="btn-group">
            <button type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-cog"></span> Options</button>
            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{!! url('expenditures/'.$datas->id.'/edit' ) !!}"><span class="glyphicon glyphicon-edit"></span> Kalo ne shpenzim</a></li>
              <li><a href="{!! url('zotimet/'.$datas->id.'/edit' ) !!}"><span class="glyphicon glyphicon-edit"></span> Edito</a></li>
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
    @include('zotimet.zotimet_results')

</table>
{!! $data->render() !!}
@stop
