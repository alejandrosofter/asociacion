<table class="table">
<tr>
	<th>Fecha</th><th style='text-align:right'>Importe</th><th style='text-align:right'></th></tr>
	<?php foreach($model as $item){?>
	<tr><td><?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$item->fecha)?></td><td style='text-align:right'>$ <?=number_format($item->importe,2)?></td>
	<td style='text-align:right' >
	<a class='imprime' data-fancybox-type='iframe' title='Imprime recibo' href='index.php?r=pagos/imprimirPago&id=<?=$item->id?>'><img src='images/iconos/famfam/page_red.png'/></a> 
	<?php if(isset($item->retencion)){?>
		<a class='imprime' data-fancybox-type='iframe' href='index.php?r=pagos/imprimirRetencion&id=<?=$item->id?>'><img src='images/iconos/famfam/page_white_star.png'/></a>
	<?php }?>
	</td>
</tr>
<?php }?>

</table>
<br><br><br><br>
<?=count($model)==0?'<i>No hay pagos realizados</i>':'';?>
<script>
$(document).ready(function() {
 $(".mostrarItems").fancybox({
    fitToView : false,
    width   : '660px',
    height    : '100%',
    autoSize  : false,
    closeClick  : false,
    openEffect  : 'none',
    closeEffect : 'none'
  });
  $(".imprime").fancybox({
    fitToView : false,
    width   : '920px',
    height    : '100%',
    autoSize  : false,
    closeClick  : false,
    openEffect  : 'none',
    closeEffect : 'none'
  });
  $(".exporta").fancybox({
    fitToView : false,
    width   : '700px',
    height    : '400px',
    autoSize  : false,
    closeClick  : false,
    openEffect  : 'none',
    closeEffect : 'none'
  });
});
</script>