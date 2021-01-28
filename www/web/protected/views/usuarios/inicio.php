<div class='contenedor'>
<h1>Bienvenido/a <?=$profesional->nombre?>!</h1>

	<div class='onethird'>

		<?php 
		$this->widget('zii.widgets.CDetailView', array(
	'data'=>$profesional,
	'attributes'=>array(
		'apellido',
		'nombre',
		
		'email',
		'telefono',
		'domicilio',
		'condicionIva.nombreIva',
		'cuit',
		'dni',
		'regimen','localidad'
	),
)); ?>

<br><br>
<h2><big>Descargar</big> NOMENCLADORES</h2>

<?php $this->renderPartial("nomencladores",array('nomencladores'=>$nomencladores));?>
	</div>
	<div class='twothirdslast'>
<div style=''>Año <input style='width:32px' type='text' id='ano' value="<?=$ano?>"> <input type='button' onclick='buscar()' value='Cambiar' class='btn primary'></input></div>
<?php 
$this->widget('zii.widgets.jui.CJuiTabs',array(
    'tabs'=>array(
    	'Pagos'=>$ultimosPagos,
        'Pendiente de Cobro'=>$pendienteCobro,
        'Impuestos'=>$impuestos,
        'Facturación Mensual'=>$this->renderPartial('_facturacionMensual',array('model'=>$mensual),true),


    ),
    // additional javascript options for the accordion plugin
    'options'=>array(
        'animated'=>'bounceslide',
    ),
));
?>
	</div>
<?=$porcentajesObraSocial?>
</div>
<br><br><br><br><br><br><br><br><br><br>
<script type="text/javascript">
function buscar()
{
	window.location = 'index.php?r=usuarios/miInicio&ano='+$('#ano').val();
}
</script>