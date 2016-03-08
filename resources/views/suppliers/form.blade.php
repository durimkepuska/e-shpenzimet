<div style="width:500px; text-align:center;  ">
<div class="form-group">
    {!! Form::label('supplier', 'Furnitori:', array('class' => 'mylabel')) !!}
    {!! Form::text('supplier', null, ['class' => 'form-control', 'require' => 'require','placeholder'=>'Furnitori'])!!}
</div>
<div class="form-group">
    {!! Form::label('address', 'Adresa:', array('class' => 'mylabel')) !!}
    {!! Form::text('address', null, ['class' => 'form-control', 'require' => 'require','placeholder'=>'Adresa'])!!}
</div>
<div class="form-group">
    {!! Form::label('telephone', 'Telefoni:', array('class' => 'mylabel')) !!}
    {!! Form::text('telephone', null, ['class' => 'form-control', 'require' => 'require','placeholder'=>'Telefoni'])!!}
</div>
<div class="form-group">
    {!! Form::label('fiscal_number', 'Numri fiskal:', array('class' => 'mylabel')) !!}
    {!! Form::text('fiscal_number', null, ['class' => 'form-control', 'require' => 'require','placeholder'=>'Numri fiskal'])!!}
</div>
<div class="form-group">
    {!! Form::label('city', 'Qyteti:', array('class' => 'mylabel')) !!}
    {!! Form::text('city', null, ['class' => 'form-control', 'require' => 'require','placeholder'=>'Qyteti'])!!}
</div>
<div class="form-group">
    {!! Form::label('country', 'Shteti:', array('class' => 'mylabel')) !!}
    {!! Form::text('country', null, ['class' => 'form-control', 'require' => 'require','placeholder'=>'Shteti'])!!}
</div>
<div class="form-group">
    {!! Form::label('contact_person', 'Personi kontaktues:', array('class' => 'mylabel')) !!}
    {!! Form::text('contact_person', null, ['class' => 'form-control', 'require' => 'require','placeholder'=>'Personi kontaktues'])!!}
</div>

<div class="form-group">
    {!! Form::submit('Ruaje',['class' => 'btn btn-primary form-control'])!!}
</div>
</div>
