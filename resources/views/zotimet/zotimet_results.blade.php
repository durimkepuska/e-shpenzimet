<?php  $fatura=0; $rows=0;  ?>
  @foreach($data as $datas)
   <?php
      $fatura = $fatura + $datas->paid_value;

      $rows = $rows+1;
   ?>
  @endforeach
<thead>
  <tr>
      <th> Total:</th>

    <th class="text-right">{!! number_format($fatura,2); !!} EUR</th>
    <th></th>
        <th></th>
    <th class="text-right">{!! $rows !!} Rreshta</th>

  </tr>
</thead>
