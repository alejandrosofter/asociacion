<?php
$this->breadcrumbs=array(
	'Condicion Ivas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CondicionIva', 'url'=>array('index')),
	array('label'=>'Create CondicionIva', 'url'=>array('create')),
	array('label'=>'Update CondicionIva', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CondicionIva', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CondicionIva', 'url'=>array('admin')),
);
?>

<h1>View CondicionIva #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombreIva',
	),
)); ?>
