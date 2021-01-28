<table class="table">
<tr><th>Fecha</th><th>Obra Social</th><th style='text-align:right'>Importe</th></tr>
<?php foreach($data as $item){?>
<tr><td><?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$item->fecha)?></td><td><?=$item->obraSocial->nombreOs;?></td> <td style='text-align:right'>$ <?=number_format($item->importe,2)?></td></tr>
<?php }?>

</table>
<?=count($data)==0?'<i>No hay facturas pendientes</i>':'';?>