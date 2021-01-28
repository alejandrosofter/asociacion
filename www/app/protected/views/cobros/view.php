<?php
$this->breadcrumbs=array(
	'Cobroses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Cobros', 'url'=>array('index')),
	array('label'=>'Create Cobros', 'url'=>array('create')),
	array('label'=>'Update Cobros', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Cobros', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Cobros', 'url'=>array('admin')),
);
?>

<h1>View Cobros #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha',
		'detalle',
		'importe',
	),
)); ?>
