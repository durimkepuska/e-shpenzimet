
<div class="form-group">
    {!! Form::label('department', 'Drejtoria:', array('class' => 'mylabel')) !!}
    {!! Form::text('department', null, ['class' => 'form-control', 'require' => 'require','placeholder'=>'Drejtoria'])!!}
</div>

<div class="form-group">
    {!! Form::submit('Ruaje',['class' => 'btn btn-primary form-control'])!!}
</div>
