<div class='row'>
<h1>Estado de Profesional</h1>

	<div class='span5'>
		<?php if($muestraBuscador)echo $this->renderPartial('_buscadorProfesional');?>
		<?php if($idProfesional)
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

	</div>
	<div class='span7'>
		<?php
		if($idProfesional)
		$this->widget('zii.widgets.jui.CJuiAccordion',array(
    'panels'=>array(
        'FACTURACION MENSUAL'=>$this->renderPartial('_facturacionMensual',array('model'=>$pendientes),true),
        'ULTIMOS PAGOS'=>$this->renderPartial('_ultimosPagos',array('model'=>$ultimosPagos),true),
        'FACTURACION OBRAS SOCIALES'=>$this->renderPartial('_graficaFacturacion',array('model'=>$porcentajesObraSocial),true),
        'IMPUESTOS'=>$this->renderPartial('_impuestos',array('model'=>$impuestos),true),
    ),
    'options'=>array(
        'animated'=>'bounceslide','autoHeight' => false,
    ),
));
		?>

	</div>
<?=($anual!=null)?$this->renderPartial('_anualProfesional',array('model'=>$anual,'anualPagos'=>$anualPagos)):'';?>
</div>