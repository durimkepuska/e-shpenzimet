<!-- shto furnitore te ri ne Expenditures-->
<div class="modal fade" id="shtoFurnitoreTeRi" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Regjistro furnitore te ri</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(['method'=>'POST','action' => 'SupplierController@store']) !!}
            {!! csrf_field() !!}
          @include('suppliers.form')
      </div>

      <div class="modal-footer">
        <div class="form-group">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Anulo</button>

              {!! Form::close()!!}
         </div>
      </div>
    </div>
  </div>
</div>
