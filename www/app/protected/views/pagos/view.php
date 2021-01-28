<?php
$this->breadcrumbs=array(
	'Pagoses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Pagos', 'url'=>array('index')),
	array('label'=>'Create Pagos', 'url'=>array('create')),
	array('label'=>'Update Pagos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Pagos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Pagos', 'url'=>array('admin')),
);
?>

<h1>View Pagos #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idProfesional',
		'importe',
		'fecha',
		'estado',
	),
)); ?>
