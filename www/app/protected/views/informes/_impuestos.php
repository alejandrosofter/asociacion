<table class="table table-condensed">
<tr><th>Impuesto</th><th style='text-align:right'>Importe</th></tr>
<?php foreach($model as $item){?>
<tr><td><?=$item->impuesto->nombreImpuesto;?></td><td style='text-align:right'>$ <?=number_format(-$item->importe,2)?></td></tr>
<?php }?>

</table>
<?=count($model)==0?'<i>No hay facturas pendientes</i>':'';?>