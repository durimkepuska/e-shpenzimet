@extends('layout.index')

@section('search_box')

 @include('users.searchForm')

@stop

@section('content')
<br><br>
<span style=" font-size: 19px; ">Për çdo pakjartësi ose problem rreth aplikacionit e-Shpenzimet, kontaktoni në këto adresa.</span>
<br><br>
  <table  class="table table-hover ">

    <thead>
      <tr>
        <th>Kontakti</th>
        
      </tr>
    </thead>
    <tbody>
     
      <tr>
        <td>Durim Këpuska<br>email: durimkepuska@gmail.com<br>tel: +383 (0) 49 130 121</td>
        
      </tr>
   
    </tbody>
   <thead>
      <tr>
        <th></th>
        
      </tr>
    </thead>
</table>


@stop
