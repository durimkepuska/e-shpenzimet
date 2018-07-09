@extends('layout.index')

@section('search_box')
    <form action="">
    	<input type="search" placeholder="Kerko...">
    </form>
@stop

@section('content')
@include('budget.buttons')

<table id="myTable" class="tablesorter table table-hover ">

  <thead>
    <tr>
      <th>Kategoria</th>
        <th>Shto Buxhet</th>
      <th>Burimi</th>
      <th>Vlera</th>

      <th>Viti</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $datas)
    <tr>

      <td>{!! $datas->spendingtype->spendingtype !!}</td>
      <td><a  data-toggle="modal" data-target="#addbudget{!!$datas->id!!}"><span class="glyphicon glyphicon-plus-sign"></span></a></td>
        <td>{!! $datas->payment_source->payment_source !!}</td>
        <td>{!! number_format($datas->value,2); !!} EUR</td>
          <td>{!! $datas->year !!}</td>

      <td>
        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-cog"></span> Options</button>
          <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">

            <li><a href="{!! url('budget/'.$datas->id.'/edit' ) !!}">Edit</a></li>

            <li>
              <a>
               {!! Form::open(['method' => 'DELETE', 'url' => 'budget/'.$datas->id, 'id'=>'myForm']) !!}
                  {!! Form::hidden('id', $datas->id) !!}
                  {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
               {!! Form::close() !!}
             </a>
            </li>
          </ul>
        </div>
      </td>
    </tr>
    @include('budget.subform')
    @endforeach
  </tbody>
  @include('budget.results')
</table>
{!! $data->render() !!}



@stop
