<?php
$this->breadcrumbs=array(
	'Profesionales'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Profesionales', 'url'=>array('index')),
	array('label'=>'Create Profesionales', 'url'=>array('create')),
	array('label'=>'Update Profesionales', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Profesionales', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Profesionales', 'url'=>array('admin')),
);
?>

<h1>View Profesionales #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'apellido',
		'email',
		'telefono',
		'idCondicionIva',
		'cuit',
		'dni',
	),
)); ?>
