<?php
$this->breadcrumbs=array(
	'Pagos Osdes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PagosOsde', 'url'=>array('index')),
	array('label'=>'Create PagosOsde', 'url'=>array('create')),
	array('label'=>'Update PagosOsde', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PagosOsde', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PagosOsde', 'url'=>array('admin')),
);
?>

<h1>View PagosOsde #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'prestadorEfector',
		'afiliado',
		'prestacion',
		'tipoPrestacion',
		'cantidadPrestaciones',
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
	),
)); ?>
