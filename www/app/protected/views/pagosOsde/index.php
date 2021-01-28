<?php
$this->breadcrumbs=array(
	'Pagos Osdes',
);
$this->menu=array(
	array('label'=>'Nuevo Pago Osde', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Pagos Osde</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pagos-osde-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'prestadorEfector',
		'afiliado',
		'prestacion',
		'tipoPrestacion',
		'cantidadPrestaciones',
		/*
		'fecha',
		'delegacionOrdenes',
		'numeroOrden',
		'tipoOrden',
		'importeEspecialista',
		'cantidadAyudante',
		'importeAnestecista',
		'cantidadAnestecista',
		'importeGastos',
		'cantidadGastos',
		'importeTotal',
		'profesionPrescriptor',
		'numeroMatriculaPrescriptor',
		'letraProvinciaPrescriptor',
		'profesionEfector',
		'numeroMatriculaEfector',
		'letraProvinciaEfector',
		'numeroTransaccion',
		'prestadorPrescriptor',
		'plan',
		'condicionIva',
		'legajoInterno',
		'codigoOperador',
		'filialTerminal',
		'delegacionTerminal',
		'numeroTerminal',
		'fechaTransaccion',
		'provinciaTerminal',
		'condicionIvaEfector',
		'nombreBeneficiario',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
