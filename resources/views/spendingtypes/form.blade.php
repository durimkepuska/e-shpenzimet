
<div class="form-group">
    {!! Form::label('spendingtype', 'Lloji i shpenzimit:', array('class' => 'mylabel')) !!}
    {!! Form::text('spendingtype', null, ['class' => 'form-control', 'require' => 'require','placeholder'=>'Lloji i shpenzimit'])!!}
</div>

<div class="form-group">
    {!! Form::submit('Ruaje',['class' => 'btn btn-primary form-control'])!!}
</div>
