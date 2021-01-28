<?php
$this->breadcrumbs=array(
	'Practicases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Practicas', 'url'=>array('index')),
	array('label'=>'Create Practicas', 'url'=>array('create')),
	array('label'=>'Update Practicas', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Practicas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Practicas', 'url'=>array('admin')),
);
?>

<h1>View Practicas #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'codigo',
		'descripcion',
		'idCategoria',
		'idSubCategoria',
		'codigoObraSocial',
	),
)); ?>
