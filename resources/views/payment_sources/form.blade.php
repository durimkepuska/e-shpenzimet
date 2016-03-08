
<div class="form-group">
    {!! Form::label('payment_source', 'Vija Buxhetore:', array('class' => 'mylabel')) !!}
    {!! Form::text('payment_source', null, ['class' => 'form-control', 'require' => 'require','placeholder'=>'Vija Buxhetore'])!!}
</div>

<div class="form-group">
    {!! Form::submit('Ruaje',['class' => 'btn btn-primary form-control'])!!}
</div>
