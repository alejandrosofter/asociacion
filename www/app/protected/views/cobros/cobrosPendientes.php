<table class="table table-condensed">
  <tr><th >Detalle</th><th style="width:110px">Importe</th><th style="width:80px"></th><th></th></tr>
  <?php foreach($pendientes as $it){?>
  <tr><td><i><small><?=$it->fecha?> | </small></i><small><?=$it->obraSocial->nombreOs?></small></td><td>$ <?=number_format($it->importe,2)?></td>
  <td>
    <a title="Ver Factura" class="imprime" data-fancybox-type="iframe" href="index.php?r=facturasObrasSocial/imprimirResumen&idFactura=<?=$it->cobroOs->idFactura?>"><img src="images/iconos/famfam/report.png" alt="Ver Factura"></a>
    
    </td>
  </tr>
  
  <?php }?>
</table>