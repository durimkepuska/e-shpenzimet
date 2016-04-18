<div class="modal fade" id="pjeserisht{!!$datas->id!!}" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close " data-dismiss="modal" style="float:right;">&times;</button>
        <h4 class="modal-title " style="text-align:left;" >
            {!!$datas->description!!}<br>
            Borxhi: {!!$datas->value-$datas->paid_value!!} EUR<br>
            Shkruani vlerën e pagesës!
        </h4>
      </div>
      <div class="modal-body">
        {!! Form::open(['method'=>'POST','action' => 'ExpenditureController@paysomething']) !!}
        {!! csrf_field() !!}
        <div class="form-group" >
           {!! Form::text('paid_value', null, ['class' => 'form-control','placeholder'=>'*Vlera në euro','required'])!!}
           {!! Form::hidden('id', $datas->id) !!}
         </div>
         </div>
         <div class="modal-footer">
           {!! Form::submit('Paguaje',['class' => 'btn btn-primary pull-right'])!!}
           {!! Form::close()!!}
             <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Anulo</button><br>
         </div>
      </div>
    </div>
  </div>
