@extends('layout.index')

@section('search_box')
    <form action="">
    	<input type="search" placeholder="Kerko...">
    </form>
@stop

@section('content')
@include('sub_budget.buttons')

<h2 style="text-align:center;">Nen Buxhetet per vitin 2016</h2><br><hr>
<div class="row">
@foreach($sub_budget as $sub_budgets)
<div class="col-sm-3">
    <div class="panel panel-primary">
        <div class="panel-heading">
           <h3 class="panel-title">Nen Buxheti fillestarë për:</h3><hr>
           {!! $sub_budgets->sub_budget->sub_budget !!} <br>
          Kategoria:  {!! $sub_budgets->spendingtype->spendingtype !!} <br>
          Nga: {!! $sub_budgets->payment_source->payment_source !!}
        </div>
        <div class="panel-body">
          {!! number_format($sub_budgets->value,2); !!} EUR

        </div>
    </div>
</div>
@endforeach
<br><br><br><br><br><br><br><br><br><br><hr>
@foreach($spendings as $spending)
<div class="col-sm-3">
    <div class="panel panel-danger">
        <div class="panel-heading">
           <h3 class="panel-title">Shpenzimet për:</h3><hr>
           {!! $spending->sub_budget !!} <br>
          Kategoria:  {!! $spending->spendingtype !!} <br>
          Nga:  {!! $spending->payment_source !!}
         </div>
        <div class="panel-body">

          {!! number_format($spending->total,2); !!} EUR
        </div>
    </div>
</div>
@endforeach
<br><br><br><br><br><br><br><br><br><br><hr>
@foreach($actual_budget as $actual_budgets)
<div class="col-sm-3">
    <div class="panel panel-info">
        <div class="panel-heading">
           <h3 class="panel-title">Buxheti i mbetur për:</h3><hr>
           {!! $actual_budgets->spendingtype !!}<br>
            {!! $actual_budgets->sub_budget !!}<br>
            {!! $actual_budgets->payment_source !!}
        </div>
        <div class="panel-body">

          {!! number_format($actual_budgets->y,2); !!} EUR
        </div>
    </div>
</div>
@endforeach



</div>

@stop
