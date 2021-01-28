<?php
$this->breadcrumbs=array(
	'Facturas Profesionals'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FacturasProfesional', 'url'=>array('index')),
	array('label'=>'Create FacturasProfesional', 'url'=>array('create')),
	array('label'=>'Update FacturasProfesional', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FacturasProfesional', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FacturasProfesional', 'url'=>array('admin')),
);
?>

<h1>View FacturasProfesional #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha',
		'fechaUpdate',
		'idProfesional',
		'importe',
		'idObraSocial',
		'estado',
	),
)); ?>
