<div class="modal fade" id="shtoLlojShpenzimi" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
        <div class="modal-title">
          Shto lloje te shpenzimeve
        </div>
      </div>
      <div class="modal-body">
      {!! Form::open(['method'=>'POST','action' => 'SpendingtypeController@store']) !!}
        {!! csrf_field() !!}
        <div class="form-group">
            {!! Form::label('spendingtype', 'Lloji i shpenzimit:', array('class' => 'mylabel')) !!}
            {!! Form::text('spendingtype', null, ['class' => 'form-control', 'require' => 'require','placeholder'=>'Emri i llojit te shpenzimit'])!!}
        </div>
        <div class="form-group" >

           {!! Form::submit('Ruaje',['class' => 'btn btn-primary pull-right'])!!}
           {!! Form::close()!!}
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Anulo</button><br>
          </div>
         </div>
      </div>
    </div>
  </div>
