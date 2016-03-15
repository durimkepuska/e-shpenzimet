<div class="modal fade" id="pjeserisht{!!$datas->id!!}" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
        <div class="modal-title pull-left">
          {!!$datas->description!!}<br>Borxhi: {!!$datas->value-$datas->paid_value!!} EUR<br>
          Shkruani vlerën e pagesës
        </div>
      </div>
      <div class="modal-body">
        {!! Form::open(['method'=>'POST','action' => 'ExpenditureController@paysomething']) !!}
        {!! csrf_field() !!}
        <div class="form-group" >
           {!! Form::text('paid_value', null, ['class' => 'form-control','placeholder'=>'*Vlera'])!!}<br>
           {!! Form::hidden('id', $datas->id) !!}
           {!! Form::submit('Paguaje',['class' => 'btn btn-primary pull-right'])!!}
           {!! Form::close()!!}
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Anulo</button><br>
          </div>
         </div>
      </div>
    </div>
  </div>
