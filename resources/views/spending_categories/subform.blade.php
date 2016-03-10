<div class="modal fade" id="shtoKategoriShpenzimi" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
        <div class="modal-title">
          Shto Kategori te shpenzimeve
        </div>
      </div>
      <div class="modal-body">
      {!! Form::open(['method'=>'POST','action' => 'SpendingCategoryController@store']) !!}
        {!! csrf_field() !!}
        <div class="form-group">
            {!! Form::label('spending_category', 'Kategoria e shpenzimit:', array('class' => 'mylabel')) !!}
            {!! Form::text('spending_category', null, ['class' => 'form-control', 'require' => 'require','placeholder'=>'Emri i Kategorise'])!!}
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
