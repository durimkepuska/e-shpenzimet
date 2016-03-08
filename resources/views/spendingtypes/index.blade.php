@extends('layout.index')

@section('search_box')

 @include('spendingtypes.searchForm')

@stop

@section('content')

@include('spendingtypes.buttons')
  <table id="myTable" class="tablesorter table table-hover ">

    <thead>
      <tr>
        <th>ID</th>
        <th>Lloji i shpenzimit</th>
        <th>Options</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $datas)
      <tr>
        <td>{!! $datas->id !!}</td>
        <td><a href="{!! action('SpendingtypeController@show', [$datas->id]) !!}">{!! $datas->spendingtype !!}</a></td>
        <td>
          <div class="btn-group">
            <button type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-cog"></span> Options</button>
            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">

              <li><a href="{!! url('spendingtypes/'.$datas->id.'/edit' ) !!}">Edit</a></li>

              <li>
                <a>
                 {!! Form::open(['method' => 'DELETE', 'url' => 'spendingtypes/'.$datas->id, 'id'=>'myForm']) !!}
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
    @include('spendingtypes.results')
</table>
 {!! $data->render() !!}

@stop
