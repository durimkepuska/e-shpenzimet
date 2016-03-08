@extends('layout.index')

@section('search_box')
    <form action="">
    	<input type="search" placeholder="Kerko...">
    </form>
@stop

@section('content')
@include('budget.buttons')


<div class="row">
@foreach($budget as $budgets)
<div class="col-sm-3">
    <div class="panel panel-primary">
        <div class="panel-heading">
           <h3 class="panel-title">Buxheti i caktuar per:</h3><hr>
           {!! $budgets->spendingtype->spendingtype !!}
        </div>
        <div class="panel-body">
          {!! number_format($budgets->value,2); !!} EUR

        </div>
    </div>
</div>
@endforeach

@foreach($spendings as $spending)
<div class="col-sm-3">
    <div class="panel panel-danger">
        <div class="panel-heading">
           <h3 class="panel-title">Shpenzimet per:</h3><hr>
            {!! $spending->spendingtype !!}
         </div>
        <div class="panel-body">

          {!! number_format($spending->total,2); !!} EUR
        </div>
    </div>
</div>
@endforeach

@foreach($actual_budget as $actual_budgets)
<div class="col-sm-3">
    <div class="panel panel-info">
        <div class="panel-heading">
           <h3 class="panel-title">Buxheti aktual per:</h3><hr>
           {!! $actual_budgets->spendingtype1 !!}
        </div>
        <div class="panel-body">

          {!! number_format($actual_budgets->y,2); !!} EUR
        </div>
    </div>
</div>
@endforeach

</div>

@stop
