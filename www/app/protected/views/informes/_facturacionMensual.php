<table class="table table-condensed">
<tr>
	<th>Fecha</th><th style='text-align:right'>Importe</th></tr>
	<?php foreach($model as $item){?>
	<tr><td><?=Yii::app()->dateFormatter->format("MM-yyyy",$item->fecha)?></td><td style='text-align:right'>$ <?=number_format($item->importe,2)?></td>
	<td>
	<a class='imprime' data-fancybox-type='iframe' href='index.php?r=informes/detalleFacturadoMes&idProfesional=<?=$item->idProfesional?>&fecha=<?=$item->fecha?>'><img src='images/iconos/famfam/page.png'/></a> 
	
	</td>
</tr>
<?php }?>

</table>
<?=count($model)==0?'<i>No hay pagos realizados</i>':'';?>