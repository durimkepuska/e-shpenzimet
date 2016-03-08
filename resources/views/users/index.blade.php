@extends('layout.index')

@section('search_box')

 @include('users.searchForm')

@stop

@section('content')

@include('users.buttons')
  <table id="myTable" class="tablesorter table table-hover ">

    <thead>
      <tr>
        <th>ID</th>
        <th>Shfrytezuesi</th>
        <th>Options</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $datas)
      <tr>
        <td>{!! $datas->id !!}</td>
        <td><a href="{!! action('UserController@show', [$datas->id]) !!}">{!! $datas->name !!}</a></td>
        <td>
          <div class="btn-group">
            <button type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-cog"></span> Options</button>
            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">

              <li><a href="{!! url('users/'.$datas->id.'/edit' ) !!}">Edit</a></li>

              <li>
                <a>
                 {!! Form::open(['method' => 'DELETE', 'url' => 'users/'.$datas->id, 'id'=>'myForm']) !!}
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
    @include('users.results')
</table>
 {!! $data->render() !!}

@stop
