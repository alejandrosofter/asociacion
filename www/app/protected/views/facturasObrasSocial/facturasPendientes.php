<table style="width:100%" class="table table-condensed">
  <tr><th>Detalle</th><th style="width:90px">Importe</th><th style="width:60px"></th></tr>
  <?php foreach($items as $it){?>
  <tr><td><i><small><?=$it->fecha?> |</small></i><b><?=$it->obraSocial->nombreOs?>: </b><?=$it->detalle?></td><td><small>$ <?=number_format($it->importe,2)?></small></td>
  <td><a class="imprime" data-fancybox-type="iframe" title="Resumen" href="index.php?r=facturasObrasSocial/imprimirResumen&idFactura=<?=$it->id?>"><img src="images/iconos/famfam/report.png" alt="Resumen"></a></td></tr>
  
  <?php }?>
</table>