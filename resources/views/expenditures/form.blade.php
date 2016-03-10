<div style="width:500px; text-align:left;  ">
<div class="form-group" >
    <span class="form_font">Furnitori</span>
    {!! Form::select('supplier_id', $supplier , null,  ['class' => 'form-control'] )!!}
   <button style=" text-align:left;" type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#shtoFurnitoreTeRi">
    <span class="glyphicon glyphicon-plus"></span> Shto furnitore te ri
    </button>
</div>
<div class="form-group" >
    <span class="form_font">Lloji i shpenzimit</span>
    {!! Form::select('spendingtype_id', $spendingtype , null,  ['class' => 'form-control'] )!!}
    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#shtoLlojShpenzimi">
     <span class="glyphicon glyphicon-plus"></span> Shto Lloj Shpenzimi
     </button>
</div>

<div class="form-group" >
      <span class="form_font">Kategoria e shpenzimit</span>
    {!! Form::select('spending_category_id', $spendingcategory , null,  ['class' => 'form-control'] )!!}
    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#shtoKategoriShpenzimi">
     <span class="glyphicon glyphicon-plus"></span> Shto Kategori Shpenzimi
     </button>
</div>
<div class="form-group">
      <span class="form_font">Pershkrimi</span>
    {!! Form::textarea('description', null,  ['class' => 'form-control', 'require' => 'require','placeholder'=>'*Pershkrimi','cols'=>50,'rows'=>3])!!}
</div>

<div class="form-group" >
      <span class="form_font">Data e shpenzimit</span>
    {!! Form::text('expenditure_date', null, ['class' => 'form-control datepicker','placeholder'=>'Data e shpenzimit'])!!}
</div>

<div class="form-group" >
    <span class="form_font">Numri i Fatures</span>
    {!! Form::text('invoice_number', null, ['class' => 'form-control','placeholder'=>'*Numri i Fatures'])!!}
</div>

<div class="form-group" >
    <span class="form_font">Vlera e Fatures</span>
    {!! Form::text('value', null, ['class' => 'form-control','placeholder'=>'*Vlera e Fatures ne euro'])!!}
</div>



<div class="form-group" >
    <span class="form_font">Statusi i Fatures</span>
    {!! Form::select('paid', $status , null,  ['class' => 'form-control','id'=>'expenditure_status','name'=>'paid'] )!!}<br>
    <div class="hiddeMe">
      <div class="paid" style=" display: none;"><br>
        <div class="form-group">
          <span class="form_font">Mjetet jane financuar nga</span>
          {!! Form::select('payment_source_id', $payment_source , null,  ['class' => 'form-control'] )!!}
        </div>
        <div class="form-group" >
          <span class="form_font">Data e pageses</span>
          {!! Form::text('payment_date', null, ['class' => 'form-control datepicker','placeholder'=>'Data e pageses'])!!}
        </div>
        <div class="form-group" >
              <span class="form_font">Vlera e pageses ne euro</span>
          {!! Form::text('paid_value', null, ['class' => 'form-control','placeholder'=>'Vlera e pageses ne euro:'])!!}
        </div>
       </div>
       <div class="dept"  style=" display: none;">
            <span class="form_font">Caktoni daten e pageses se borxhit</span>
          {!! Form::text('dept_paid_date', null, ['class' => 'form-control datepicker','placeholder'=>'Data e pageses se borxhit'])!!}
        </div>
    </div>
</div>

  {!! Form::hidden('department_id', Auth::user()->department_id, ['class' => 'form-control'])!!}

<div class="form-group">
    {!! Form::submit('Ruaje',['class' => 'btn btn-primary form-control'])!!}
</div>
</div>
