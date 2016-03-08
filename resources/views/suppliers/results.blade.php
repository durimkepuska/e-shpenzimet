<?php $rows=0; ?>
  @foreach($data as $datas)
   <?php
      $rows = $rows+1;
   ?>
  @endforeach
<thead>
  <tr>
      <th> </th>
      <th> </th>
      <th> </th>
      <th> </th>
      <th> </th>
      <th> </th>
      <th> </th>
      <th> </th>
      <th>{!! $rows !!} Rreshta</th>
  </tr>
</thead>
