<table class='table condensed'>
<tr><td></td><th>Profesional</th><th>Fecha</th><th>Paciente</th><th>Nro Orden</th><th>Nro Afiliado</th><th>O.S</th><th>Nom.</th><th>Importe</th></tr>
<?php foreach($ultimas as $factura){?>
<tr>
<td><a href="#" title="Copiar datos al formulario" onclick="pasarDatos(<?=$factura->id;?>)"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAHYSURBVDjLlVLPS1RxHJynpVu7KEn0Vt+2l6IO5qGCIsIwCPwD6hTUaSk6REoUHeoQ0qVAMrp0COpY0SUIPVRgSl7ScCUTst6zIoqg0y7lvpnPt8MWKuuu29w+hxnmx8dzzmE5+l7mxk1u/a3Dd/ejDjSsII/m3vjJ9MF0yt93ZuTkdD0CnnMO/WOnmsxsJp3yd2zfvA3mHOa+zuHTjy/zojrvHX1YqunAZE9MlpUcZAaZQBNIZUg9XdPBP5wePuEO7eyGQXg29QL3jz3y1oqwbvkhCuYEOQMp/HeJohCbICMUVwr0DvZcOnK9u7GmQNmBQLJCgORxkneqRmAs0BFmDi0bW9E72PPda/BikwWi0OEHkNR14MrewsTAZF+lAAWZEH6LUCwUkUlntrS1tiG5IYlEc6LcjYjSYuncngtdhakbM5dXlhgTNEMYLqB9q49MKgsPjTBXntVgkDNIgmI1VY2Q7QzgJ9rx++ci3ofziBYiiELQEUAyhB/D29M3Zy+uIkDIhGYvgeKvIkbHxz6Tevzq6ut+ANh9fldetMn80OzZVVdgLFjBQ0tpEz68jcB4ifx3pQeictVXIEETnBPCKMLEwBIZAPJD767V/ETGwsjzYYiC6vzEP9asLo3SGuQvAAAAAElFTkSuQmCC" ></a></td>
	<td><a target="_blank" href="index.php?r=facturasProfesional/update&id=<?=$factura->id?>"><?=$factura->profesional->nombreProfesionales?></a></td><td><?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$factura->fechaConsulta)?></td><td><?=$factura->paciente?></td><td><?=$factura->nroOrden?></td><td><?=$factura->nroAfiliado?></td><td><?=$factura->obraSocial->nombreOs?></td><td><?=$factura->nombreNomenclador?></td><td><?=Yii::app()->numberFormatter->formatCurrency($factura->importe,"")?> <?=($factura->esDoble?"(2)":"")?><span class="label label-warning"><?=($factura->extras)?></span></td></tr>
<?php }?>
</table>
<script>
function pasarDatos(id)
{
	$.getJSON("index.php?r=facturasProfesional/getDatosFactura",{idFactura:id},function(res){
     $.unblockUI();
     $("#FacturasProfesional_fechaConsulta").val(res.fechaConsulta);
     $("#FacturasProfesional_idProfesional").val(res.idProfesional);
     $("#FacturasProfesional_paciente").val(res.paciente);
     $("#FacturasProfesional_nroAfiliado").val(res.nroAfiliado);
     $("#FacturasProfesional_nroOrden").val(res.nroOrden);
     $("#FacturasProfesional_idObraSocial").val(res.idObraSocial);
     $("#FacturasProfesional_idRagoNomenclador").val(res.idRangoNomenclador);
     $("#FacturasProfesional_importe").val(res.importe);
     
     if(res.importeFijo==1)$("#FacturasProfesional_importeFijo").prop('checked', true);
     if(res.es100==1)$("#FacturasProfesional_es100").prop('checked', true);
     if(res.es50==1)$("#FacturasProfesional_es50").prop('checked', true);
     if(res.es75==1)$("#FacturasProfesional_es75").prop('checked', true);
     if(res.esDoble==1)$("#FacturasProfesional_esDoble").prop('checked', true);

     $('#FacturasProfesional_idObraSocial').select2().trigger('change');
     $('#FacturasProfesional_idRangoNomenclador').select2().trigger('change');
     $('#FacturasProfesional_idProfesional').select2().trigger('change');
     
     setTimeout(function(){
	  $("#FacturasProfesional_idNomenclador").val(res.idNomenclador);
	  $('#FacturasProfesional_idNomenclador').select2().trigger('change');
	}, 2000);



    })
}

</script>