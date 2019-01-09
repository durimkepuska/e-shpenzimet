<div class="modal fade" id="shkrarko" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Gjenero raport të shpenzimeve</h4>
       </div>
       <div class="modal-body">
         {!! Form::open(['method'=>'POST','action' => 'WebController@generateRaport']) !!}
           {!! csrf_field() !!}
             <div class="form-inline">
               <div class="form-group" >
                 {!! Form::label('department', 'Drejtoria:', array('class' => 'mylabel')) !!}
                 {!! Form::select('department', $department , null,  ['class' => 'form-control'] )!!}
                </div><hr>
                <div class="form-group" >
                 {!! Form::label('year', 'Viti:', array('class' => 'mylabel')) !!}
                 {!! Form::select('year', ['0'=>'Të gjithë','2016'=>2016,'2017'=>2017,'2018'=>2018,'2019'=>2019] , null,  ['class' => 'form-control'] )!!}
                </div>
             </div><hr>
             <div class="form-inline">
              <div class="form-group" >
                 {!! Form::label('type', 'Lloji i dokumentit:', array('class' => 'mylabel')) !!}
                 {!! Form::select('type', $type , null,  ['class' => 'form-control'] )!!}
               </div>
             </div>
        </div>
        <div class="modal-footer">
          {!! Form::submit('Shkarko',['class' => 'btn btn-primary pull-right '])!!}
          {!! Form::close()!!}
        <button  class="btn btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Anulo</button>
        </div>
    </div>
  </div>
</div>
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header" style="padding:35px 50px;">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4><span class="glyphicon glyphicon-lock"></span> Kyçu</h4>
		</div>
		<div class="modal-body" style="padding:40px 50px;">
      {!! Form::open(['url'=>'/auth/login']) !!}
        {!! csrf_field() !!}
        <div class="form-group">
          <label for="usrname"><span class="glyphicon glyphicon-user"></span> Email</label>
          {!! Form::text('email', null, ['class' => 'form-control','placeholder'=>'Email']) !!}
        </div>
        <div class="form-group">
           <label for="psw"><span class="glyphicon glyphicon-eye-close"></span> Fjalëkalimi</label><br>
           <input type="password" name="password" class="form-control" value="" placeholder="Fjalekalimi">
        </div>
      </div>
    <div class="modal-footer">
    {!! Form::submit('Kyçu',['class' => 'btn btn-primary pul-right'])!!}
    {!! Form::close()!!}
    <button  class="btn btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Anulo</button>
    <br><br><p class="pull-left"  style="font-size:11px; "> <a href="{!!url('password/email')!!}">Kam harruar fjalëkalimin!</a></p>
    <p class="pull-right" style="font-size:11px; color:red;"> Vetëm për zyrtarët përgjegjës!</p>

    </div>
	</div>
</div>
</div>
