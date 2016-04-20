<div style="width:500px; text-align:center;  ">
<div class="form-group">
    {!! Form::label('sub_budget', 'Nën buxheti:', array('class' => 'mylabel')) !!}
    {!! Form::text('sub_budget', null, ['class' => 'form-control', 'require' => 'require','placeholder'=>'Nën buxheti'])!!}
</div>
{!! Form::hidden('department_id', Auth::user()->department_id, ['class' => 'form-control'])!!}

<div class="form-group">
    {!! Form::submit('Ruaje',['class' => 'btn btn-primary form-control'])!!}
</div>
</div>
