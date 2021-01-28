<table class="table table-condensed">
<tr><th>Fecha</th><th>Obra Social</th><th style='text-align:right'>Importe</th></tr>
<?php foreach($model as $item){?>
<tr><td><?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$item->fecha)?></td><td><?=$item->obraSocial->nombreOs;?></td><td style='text-align:right'><?=number_format($item->importe,2)?></td></tr>
<?php }?>

</table>
<?=count($model)==0?'<i>No hay facturas pendientes</i>':'';?>