<?php
$this->breadcrumbs=array(
	'Pagos Osdes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar PagosOsde', 'url'=>array('index')),
	array('label'=>'Nuevo PagosOsde', 'url'=>array('create')),
);


<h1>Administracion Pagos Osdes</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pagos-osde-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
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
