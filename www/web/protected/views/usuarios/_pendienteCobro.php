<table class="table table-condensed">
<tr><th>Ref.</th><th style='width:80px'>Fecha</th><th>Detalle</th><th style='text-align:right'>Importe</th></tr>
<?php foreach($model as $item){?>
<tr><td><small><?=$item->idFacturaObraSocial?></small></td> <td><small><?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$item->facturaObraSocial->fecha)?></small></td><td><?=$item->facturaObraSocial->obraSocial->nombreOs;?></td><td style='text-align:right'><small>$ <?=number_format($item->facturaProfesional->importe,2)?></small></td></tr>
<?php }?>

</table>
<?=count($model)==0?'<i>No hay facturas pendientes</i>':'';?>