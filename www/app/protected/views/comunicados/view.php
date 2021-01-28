<?php
$this->breadcrumbs=array(
	'Comunicadoses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Comunicados', 'url'=>array('index')),
	array('label'=>'Create Comunicados', 'url'=>array('create')),
	array('label'=>'Update Comunicados', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Comunicados', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Comunicados', 'url'=>array('admin')),
);
?>

<h1>View Comunicados #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha',
		'mensaje',
		'enviaMail',
	),
)); ?>
