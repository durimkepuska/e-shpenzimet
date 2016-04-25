

<div class="form-group" >
    {!! Form::label('spendingtype_id', 'Kategoria:', array('class' => 'mylabel')) !!}
    {!! Form::select('spendingtype_id', $spendingtype , null,  ['class' => 'form-control'] )!!}
</div>
<div class="form-group" >
    {!! Form::label('payment_source_id', 'Mjetet financohen nga:', array('class' => 'mylabel')) !!}
    {!! Form::select('payment_source_id', $payment_source , null,  ['class' => 'form-control'] )!!}
</div>
<div class="form-group" >
    {!! Form::label('sub_budget_id', 'Nen Buxheti:', array('class' => 'mylabel')) !!}
    {!! Form::select('sub_budget_id', $sub_budget , null,  ['class' => 'form-control'] )!!}
</div>

<div class="form-group">
    {!! Form::label('value', 'Vlera:', array('class' => 'mylabel')) !!}
    {!! Form::text('value', null, ['class' => 'form-control', 'required' => 'required','placeholder'=>'Vlera ne Euro'])!!}
</div>
{!! Form::hidden('department_id', Auth::user()->department_id, ['class' => 'form-control'])!!}
