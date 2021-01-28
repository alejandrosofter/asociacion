<?php
$this->breadcrumbs=array(
	'Retenciones Detalles'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RetencionesDetalle', 'url'=>array('index')),
	array('label'=>'Create RetencionesDetalle', 'url'=>array('create')),
	array('label'=>'Update RetencionesDetalle', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RetencionesDetalle', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RetencionesDetalle', 'url'=>array('admin')),
);
?>

<h1>View RetencionesDetalle #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idPago',
		'detalle',
	),
)); ?>
