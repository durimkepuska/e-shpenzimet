@extends('layout.index')

@section('search_box')
    @include('expenditures.searchForm')
@stop

@section('content')


@include('expenditures.buttons')

{!! Form::open(['method'=>'POST','action' => 'ExpenditureController@generateRaport']) !!}

     {!! csrf_field() !!}


     <div class="form-group" ><hr>
          {!! Form::label('paid', 'Cilat shpenzime i deshiron ne raport?', array('class' => 'mylabel')) !!}
          &nbsp;&nbsp;&nbsp;&nbsp;Te paguarat:&nbsp; {!! Form::radio('paid',1, false, ['class' => 'field']) !!}
          &nbsp;&nbsp;&nbsp;&nbsp;Borxhet:&nbsp;  {!! Form::radio('paid', 2, false, ['class' => 'field']) !!}
          &nbsp;&nbsp;&nbsp;&nbsp;Te gjitha:&nbsp;  {!! Form::radio('paid', 3, true, ['class' => 'field']) !!}<br><br>
     </div><hr>

     <div class="form-inline">
       <div class="form-group" >
          {!! Form::label('start_date', 'Data e shpenzimit:&nbsp;&nbsp;&nbsp;&nbsp; Prej...', array('class' => 'mylabel')) !!}
          {!! Form::text('start_date', null, ['class' => 'form-control datepicker','placeholder'=>'Data'])!!}&nbsp;&nbsp;
        </div>
        <div class="form-group" >
         {!! Form::label('end_date', 'Deri...', array('class' => 'mylabel')) !!}
         {!! Form::text('end_date', null, ['class' => 'form-control datepicker','placeholder'=>'Data'])!!}
        </div>
    </div><hr>

    <div class="form-inline">
      <div class="form-group" >
         {!! Form::label('supplier_id', 'Furnitori:', array('class' => 'mylabel')) !!}
         {!! Form::select('supplier_id', $supplier , null,  ['class' => 'form-control','id'=>'suppliers'] )!!}
           &nbsp;&nbsp;&nbsp;&nbsp;Te gjithe furnitoret:&nbsp;  {!! Form::radio('allSuppliers', 1, false, ['class' => 'field','onclick'=>'blockSuppliers()']) !!}<br><br>
       </div>
    </div><hr>

    <div class="form-inline">
      <div class="form-group" >
           {!! Form::label('spendingtype', 'Lloji i Shpenzimeve:', array('class' => 'mylabel')) !!}
           {!! Form::select('spendingtype', $spendingtype , null,  ['class' => 'form-control','id'=>'spendingtypes'] )!!}
           &nbsp;&nbsp;&nbsp;&nbsp;Te gjitha llojet e shpenzimeve:&nbsp;  {!! Form::radio('allSpendingtypes',1, false, ['class' => 'field','onclick'=>'blockSpendingTypes()']) !!}<br><br>
      </div>
    </div><hr>

    <div class="form-inline">
      <div class="form-group" >
           {!! Form::label('spendingcategory', 'Kategoria e Shpenzimeve:', array('class' => 'mylabel')) !!}
           {!! Form::select('spendingcategory', $spendingcategory , null,  ['class' => 'form-control','id'=>'spendingcategory'] )!!}
           &nbsp;&nbsp;&nbsp;&nbsp;Te gjitha kategorite e shpenzimeve:&nbsp;  {!! Form::radio('allSpendingCategories',1, false, ['class' => 'field','onclick'=>'blockSpendingCategories()']) !!}<br><br>
      </div>
    </div><hr>

    <div class="form-inline">
      <div class="form-group" >
           {!! Form::label('payment_source', 'Vija Buxhetore:', array('class' => 'mylabel')) !!}
           {!! Form::select('payment_source', $payment_source , null,  ['class' => 'form-control','id'=>'paymentsources'] )!!}
           &nbsp;&nbsp;&nbsp;&nbsp;Te gjitha vijat buxhetore:&nbsp;  {!! Form::radio('allPaymentSources', 1, false, ['class' => 'field','onclick'=>'blockPaymentSources()']) !!}<br><br>
      </div>
    </div>
    <hr>
    <div class="form-inline">
      <div class="form-group" >
           {!! Form::label('type', 'Lloji i dokumentit:', array('class' => 'mylabel')) !!}
           {!! Form::select('type', $type , null,  ['class' => 'form-control','id'=>'2'] )!!}
      </div>
    </div>
    <hr>


    {!! Form::hidden('department_id', Auth::user()->department_id, ['class' => 'form-control'])!!}

    <div class="form-group">
         {!! Form::submit('Gjenero raport',['class' => 'btn btn-primary form-control'])!!}
     </div>


    {!! Form::close()!!}
    

    <script>
    function blockSuppliers() {
        document.getElementById("suppliers").disabled = true;
    }
    function blockSpendingTypes() {
        document.getElementById("spendingtypes").disabled = true;
    }
    function blockPaymentSources() {
        document.getElementById("paymentsources").disabled = true;
    }
    function blockSpendingCategories() {
        document.getElementById("spendingcategory").disabled = true;
    }
    </script>

@stop
