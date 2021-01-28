<!-- <h3><?=$model->nombreOs?></h3> -->
<div class="span3">
	<table class="table table-condensed">
		<tr><th>Email: </th> <td><?=$model->email?></td></tr>
		<tr><th>Tel: </th> <td><?=$model->telefono?></td></tr>
		<tr><th>Direccion: </th> <td><?=$model->direccion?></td></tr>
		<tr><th>Cuit: </th> <td><?=$model->cuit?></td></tr>
	</table>

	<table class="table table-condensed">
		<tr><th><big>$ SALDO</big>  </th> <td><big><?=$saldo?></big></td></tr>
	</table>
	<textarea id="mensaje" style="width: 100%" rows="4" placeholder="Mensaje al prestador..."></textarea>
	<a onclick="enviarMensaje()" class="btn btn-success" style="width: 100%">ENVIAR MENSAJE</a>
</div>

<div class="span7"> 
	<div style="float:right;">
	<h1>CTA CTE<small> a la fecha</small> </h1>

		<table style="font-size:10px" class="table table-condensed">
		<tr><th>Fecha</th><th>Tipo</th><th>Detalle</th><th>Nro Factura</th><th>Estado</th><th>$ Importe</th><th>$ SALDO</th></tr>
		<?php $sum=0;$saldo=0; for ($i=0; $i < count($cuenta) ; $i++) { $value=$cuenta[$i];$sum+=$value['importe']; ?>
		<tr class="<?=$value['estado']=='PENDIENTE'?'seleccionado':''?>">
			<td style="width: 90px"><?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$value['fecha']) ?></td>
			<td style="width: 90px"><?=$value['tipo'] ?></td>
			<td style="width: 450px"><?=$value['detalle'] ?></td>
			<td><?=$value['nroFactura'] ?></td>
			<td><?=$value['estado'] ?></td>
			<td style="width: 90px;text-align: right;"><?=number_format($value['importe'],2) ?></td>
			<td style="width: 90px;text-align: right;"><?=number_format($value['saldo'],2) ?></td>
			
		</tr>
		<?php } ?>
		<tr><th></th><th></th><th></th><th></th><th>TOTAL</th><th>$ <?=number_format($sum,2)?></th></tr>
		</table>
	</div>

</div>

<script type="text/javascript">
function enviarMensaje()
{
	var idObraSocial=<?=$model->id;?>;

	var mensaje=$("#mensaje").val();
	$.blockUI({ message: '<h1><img src="images/loader.gif" /> Espere un momento por favor...</h1>' }); 
		$.get("index.php?r=ObrasSociales/enviarMensaje",{idObraSocial:idObraSocial,mensaje:mensaje},function(res){
     
      $.unblockUI();
      swal("Bien!","Se ha enviado el mensaje con exito!");
      $("#mensaje").val("");

    });
}

function buscar()
{
	var idObraSocial=<?=$model->id;?>;
	var fechaDesde='$("#fechaDesde").val()';
	var fechaHasta='$("#fechaHasta").val()';
	busca_(idObraSocial,fechaDesde,fechaHasta);
}
function busca_(idOs,fechaDesde,fechaHasta)
{
	$.get( "index.php?r=facturasObrasSocial/informe_",{idObraSocial:idOs,fechaDesde:fechaDesde,fechaHasta:fechaHasta,ocultaCabezal:true}, function( data ) {
 	$('#facturaOs').html(data);
	});
}
</script>