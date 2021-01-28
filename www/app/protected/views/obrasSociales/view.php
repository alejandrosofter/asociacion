<?php
$this->breadcrumbs=array(
	'Obras Sociales'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ObrasSociales', 'url'=>array('index')),
	array('label'=>'Create ObrasSociales', 'url'=>array('create')),
	array('label'=>'Update ObrasSociales', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ObrasSociales', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ObrasSociales', 'url'=>array('admin')),
);
?>

<h1>View ObrasSociales #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombreOs',
		'email',
		'contacto',
	),
)); ?>
