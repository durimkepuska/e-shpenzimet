<div class="modal fade" id="addsubbudget{!!$datas->id!!}" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close " data-dismiss="modal" style="float:right;">&times;</button>
        <h4 class="modal-title " style="text-align:left;" >

            Shkruani vlerën e nen buxhetit që do të shtoni për:<br>{!!$datas->sub_budget->sub_budget!!}
        </h4>
      </div>
      <div class="modal-body">
        {!! Form::open(['method'=>'POST','action' => 'SubBudgetContainerController@addsub_budget']) !!}
        {!! csrf_field() !!}
        <div class="form-group" >
           {!! Form::text('value', null, ['class' => 'form-control','placeholder'=>'*Vlera në euro','required'])!!}
           {!! Form::hidden('id', $datas->id) !!}
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
