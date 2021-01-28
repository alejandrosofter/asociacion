<div id="printable">

<b>PERIODO desde </b> <?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$fechaDesde) ?> <b>hasta</b> <?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$fechaHasta) ?> 
<div style="display:<?=$ocultaCabezal?'none':''?>" class="inline-form">
<img style="float:right;padding: 30px" src="images/logo2.bmp">
<h1>RESUMEN DE FACTURACION A OBRAS SOCIALES </h1>
</div>
<table style="font-size:10px" class="table table-condensed">
<tr><th>Fecha</th><th>Obra Social</th><th>Detalle</th><th>Nro Factura</th><th>Estado</th><th>$ Importe</th></tr>
<?php $sum=0; for ($i=0; $i < count($data) ; $i++) { $value=$data[$i];$sum+=$value->importe; ?>
<tr>
	<td style="width: 90px"><?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$value->fecha) ?></td>
	<td style="width: 390px"><?=$value->obraSocial->nombreOs ?></td>
	<td style="width: 450px"><?=$value->detalle ?></td>
	<td><?=$value->nroFactura ?></td>
	<td><?=$value->estado ?></td>
	<td style="width: 90px;text-align: right;"><?=number_format($value->importe,2) ?></td>
	
</tr>
<?php } ?>
<tr><th></th><th></th><th></th><th></th><th>TOTAL</th><th>$ <?=number_format($sum,2)?></th></tr>
</table>
</div>
<a class="btn btn-success" style="width: 100%;display:none" id="btnImprimir" onclick="imprimir()">IMPRIMIR</a>
<script>
function imprimir()
{
  //$("#printable").print();
   var divToPrint=document.getElementById('printable');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><head></head><body  onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);
}
</script>