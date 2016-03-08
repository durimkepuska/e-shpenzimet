
<div class="form-group">
    {!! Form::label('spending_category', 'Kategoria e shpenzimit:', array('class' => 'mylabel')) !!}
    {!! Form::text('spending_category', null, ['class' => 'form-control', 'require' => 'require','placeholder'=>'Kategoria'])!!}
</div>

<div class="form-group">
    {!! Form::submit('Ruaje',['class' => 'btn btn-primary form-control'])!!}
</div>
