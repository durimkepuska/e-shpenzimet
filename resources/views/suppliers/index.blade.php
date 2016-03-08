@extends('layout.index')

@section('search_box')

 @include('suppliers.searchForm')

@stop

@section('content')

@include('suppliers.buttons')
  <table id="myTable" class="tablesorter table table-hover ">

    <thead>
      <tr>
        <th>ID</th>
        <th>Furnitori</th>
        <th>Adresa</th>
        <th>Tel</th>
        <th>Nr. fiskal</th>
        <th>Qyteti</th>
        <th>Shteti</th>
        <th>kontakti</th>

        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $datas)
      <tr>
        <td>{!! $datas->id !!}</td>
        <td><a href="{!! action('SupplierController@show', [$datas->id]) !!}">{!! $datas->supplier !!}</a></td>
        <td>{!! $datas->address !!}</td>
        <td>{!! $datas->telephone !!}</td>
        <td>{!! $datas->fiscal_number !!}</td>
        <td>{!! $datas->city !!}</td>
        <td>{!! $datas->country !!}</td>
        <td>{!! $datas->contact_person !!}</td>
        
        <td>
          <div class="btn-group">
            <button type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-cog"></span> Options</button>
            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">

              <li><a href="{!! url('suppliers/'.$datas->id.'/edit' ) !!}">Edit</a></li>

              <li>
                <a>
                 {!! Form::open(['method' => 'DELETE', 'url' => 'suppliers/'.$datas->id, 'id'=>'myForm']) !!}
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
    @include('suppliers.results')
</table>
 {!! $data->render() !!}

@stop
