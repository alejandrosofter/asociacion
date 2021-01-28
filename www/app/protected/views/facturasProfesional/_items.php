<table class="table table-condensed">
<tr>
	<th>Ref.</th>
	<th style='style="width: 90px;'>Fecha</th>
	<th>Profesional</th>
	<th>Importe</th>
	<th>Estado</th>
	<th></th>
</tr>
<?php foreach($items as $item){?>
<tr>
	<td><?=$item->id?></td>
	<td><?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$item->fecha);?></td>
	<td><?=$item->profesional->nombreProfesionales;?></td>
	<td><?=number_format($item->importe,2);?></td>
	<td style='style="width: 120px;'><?=$item->estado;?></td>
	<td><img onclick='quitarFactura(<?=$item->id?>)' src='images/iconos/famfam/0.png'></img></td>
</tr>
<?php }?>

</table>
<?=count($items)==0?'<i>No hay intems!</i>':'';?>
<script>
function quitarFactura(id)
{
	 if (confirm("Desea quitar esta factura Ref. "+id+" permanentemente?") == true) {
        quitar(id);
        
    } 
}
function quitar(id)
{
	$.getJSON('index.php?r=facturasProfesional/quitarFactura',{idFactura:id}, function(data) {
 	cambiaObraSocial();

});
}
</script>