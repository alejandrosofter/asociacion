<?php
$this->breadcrumbs=array(
	'Pagos'=>array('/pagos'),'Detalle de la Retención'
);

$this->menu=array(
	array('label'=>'List Retenciones', 'url'=>array('index')),
	array('label'=>'Create Retenciones', 'url'=>array('create')),
	array('label'=>'Update Retenciones', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Retenciones', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Retenciones', 'url'=>array('admin')),
);
?>

<h1>Retención en Pago</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'importeRetencion',
		'importeBase',
		'tabla.masDe',
		'tabla.a',
		'tabla.agregadoEfectivo',
		'tabla.agregadoPorcentaje',
	),
)); ?>
