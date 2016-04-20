<div class="modal fade" id="shtoNenBuxhet" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close " data-dismiss="modal" style="float:right;">&times;</button>
        <h4 class="modal-title " style="text-align:left;" >
            Shto nën buxhet të ri.
        </h4>
      </div>
      <div class="modal-body">
        {!! Form::open(['method'=>'POST','action' => 'SubBudgetController@store']) !!}
        {!! csrf_field() !!}
        <div class="form-group" >
           {!! Form::text('sub_budget', null, ['class' => 'form-control','placeholder'=>'Nën buxheti','required'])!!}
           {!! Form::hidden('department_id', Auth::user()->department_id) !!}
         </div>
         </div>
         <div class="modal-footer">
           {!! Form::submit('Regjistro',['class' => 'btn btn-primary pull-right'])!!}
           {!! Form::close()!!}
             <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Anulo</button><br>
         </div>
      </div>
    </div>
  </div>
