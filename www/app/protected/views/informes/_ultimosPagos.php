<table class="table table-condensed">
<tr>
	<th>Fecha</th><th style='text-align:right'>Importe</th></tr>
	<?php foreach($model as $item){?>
	<tr><td><?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$item->fecha)?></td><td style='text-align:right'><?=number_format($item->importe,2)?></td>
	<td>
	<a class='imprime' data-fancybox-type='iframe' href='index.php?r=pagos/imprimirPago&id=<?=$item->id?>'><img src='images/iconos/famfam/page_red.png'/></a> 
	<?php if(isset($item->retencion)){?>
		<a class='imprime' data-fancybox-type='iframe' href='index.php?r=pagos/imprimirRetencion&id=<?=$item->id?>'><img src='images/iconos/famfam/page_white_star.png'/></a>
	<?php }?>
	</td>
</tr>
<?php }?>

</table>
<?=count($model)==0?'<i>No hay pagos realizados</i>':'';?>