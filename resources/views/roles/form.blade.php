
<div class="form-group">
    {!! Form::label('role', 'Roli:', array('class' => 'mylabel')) !!}
    {!! Form::text('role', null, ['class' => 'form-control', 'require' => 'require','placeholder'=>'Roli'])!!}
</div>

<div class="form-group">
    {!! Form::submit('Ruaje',['class' => 'btn btn-primary form-control'])!!}
</div>
