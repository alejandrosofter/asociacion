<?php if($agrupa){?>
<a class="imprime" data-fancybox-type="iframe" href="index.php?r=site/auditoriaPendientes_&ano=<?=$ano?>"> <b> <big>LISTADO FACTURAS PENDIENTES <?=$ano?></big></b></a>
<br>
<?php }?>

<?php if(!$agrupa){?>
	<?=$cabezal?>
	<link rel="stylesheet" type="text/css" href="css/impresion.css"/>
	<div id="impresion" style="padding: 20px">
		<h3>FACTURAS PENDIENTES (pendientes período)</h3>
	<table class="tabla22">
	<tr><th width="60px">FECHA</th><th width="100px">O.S</th><th>DETALLE</th><th>ESTADO</th><th width="60px">IMPORTE</th></tr>
<?php $sum=0; for ($i=0; $i < count($pendientes) ; $i++) { $sum+=$pendientes[$i]['importeFactura'];?> 
<tr><td class="nombre"><?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$pendientes[$i]['fechaFactura'])?></td><td class="nombre"><?=$pendientes[$i]['nombreObraSocial']?></td><td class="nombre"><?=$pendientes[$i]['detalleFactura']?></td><td class="nombre"><?=$pendientes[$i]['estado']?></td><td class="importe">$ <?=number_format($pendientes[$i]['importeFactura'])?></td></tr> 

<?php }?>
<tr><td></td><td></td><td></td><td><b>TOTAL</b></td><td><b><?=number_format($sum,2)?></b></td></tr>
</table>
<h3>FACTURAS PENDIENTES (canceladas en otro período)</h3>
<table class="tabla22">
	<tr><th width="60px">FECHA</th><th width="100px">O.S</th><th>DETALLE</th><th>ESTADO</th><th width="60px">COBRO EN..</th><th width="60px">IMPORTE</th></tr>
<?php $sum2=0; for ($i=0; $i < count($canceladas) ; $i++) { $sum2+=$canceladas[$i]['importeFactura'];?> 
<tr><td class="nombre"><?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$canceladas[$i]['fechaFactura'])?></td><td class="nombre"><?=$canceladas[$i]['nombreObraSocial']?></td><td class="nombre"><?=$canceladas[$i]['detalleFactura']?></td><td class="nombre"><?=$canceladas[$i]['estado']?></td><td class="nombre"><?=$canceladas[$i]['fechaCobro']?></td><td class="importe">$ <?=number_format($canceladas[$i]['importeFactura'])?></td></tr> 

<?php }?>
<tr><td></td><td></td><td></td><td></td><td><b>TOTAL</b></td><td><b><?=number_format($sum2,2)?></b></td></tr>
</table>

<h3>TOTALES </h3>
<table class="tabla22">
	
<tr><td></td><td></td><td></td><td></td><td style="text-align: right;"><b>PENDIENTES</b></td><td style="text-align: right;"><b><?=number_format($sum,2)?></b></td></tr>
<tr><td></td><td></td><td></td><td></td><td style="text-align: right;"><b>PENDIENTES (en otro período)</b></td><td style="text-align: right;"><b><?=number_format($sum2,2)?></b></td></tr>
<tr><td></td><td></td><td></td><td></td><td style="text-align: right;"><b>TOTALES</b></td><td style="text-align: right;"><b><?=number_format($sum2+$sum,2)?></b></td></tr>
</table>
</div>
 <input id="botonImprimir" type="button" value="IMPRIMIR" onclick="imprimir()" />
<?php }?>
<script>
function imprimir()
{

   window.print()
}

</script>