<div style="width:500px; text-align:left;  ">

  <div class="form-group" >
      <span class="form_font">Lloji i shpenzimit</span>
      {!! Form::select('spendingtype_id', $spendingtype , null,  ['class' => 'form-control'] )!!}
      <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#shtoLlojShpenzimi">
       <span class="glyphicon glyphicon-plus"></span> Shto Lloj Shpenzimi
       </button>
  </div>
<div class="form-group">
      <span class="form_font">Përshkrimi i Projektit</span>
    {!! Form::textarea('description', null,  ['class' => 'form-control', 'require' => 'require','placeholder'=>'*Përshkrimi','cols'=>50,'rows'=>3])!!}
</div>

<div class="form-group" >
      <span class="form_font">Data e planifikuar e projektit</span>
    {!! Form::text('expenditure_date', null, ['class' => 'form-control datepicker','placeholder'=>'Data'])!!}
</div>

<div class="form-group" >
    <span class="form_font">Vlera e zotimit të mjeteve në euro</span>
    {!! Form::text('value', null, ['class' => 'form-control','placeholder'=>'*Vlera'])!!}
</div>

  {!! Form::hidden('department_id', Auth::user()->department_id, ['class' => 'form-control'])!!}
  {!! Form::hidden('paid', 4, ['class' => 'form-control'])!!}

<div class="form-group">
    {!! Form::submit('Ruaje',['class' => 'btn btn-primary form-control'])!!}
</div>
</div>
