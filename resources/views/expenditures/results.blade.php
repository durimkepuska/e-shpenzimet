<?php  $fatura=0; $rows=0; $paguar=0; $borxh=0; ?>
  @foreach($data as $datas)
   <?php
      $fatura = $fatura + $datas->value;
      $paguar = $paguar + $datas->paid_value;
      $borxh = $fatura - $paguar;
      $rows = $rows+1;
   ?>
  @endforeach
<thead>
  <tr>
      <th> </th>
    <th> Total:</th>
    <th class="text-right">{!! number_format($fatura,2); !!} EUR</th>
    <th class="text-right">{!! number_format($paguar,2); !!} EUR</th>
    <th class="text-right"> {!! number_format($borxh,2); !!} EUR</th>
    <th></th>
    <th class="text-right">{!! $rows !!} Rreshta</th>

  </tr>
</thead>
