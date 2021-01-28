<?php
$this->breadcrumbs=array(
	'Cobros Tiposes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CobrosTipos', 'url'=>array('index')),
	array('label'=>'Create CobrosTipos', 'url'=>array('create')),
	array('label'=>'Update CobrosTipos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CobrosTipos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CobrosTipos', 'url'=>array('admin')),
);
?>

<h1>View CobrosTipos #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombreTipoCobro',
	),
)); ?>
