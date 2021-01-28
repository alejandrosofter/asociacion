<?php
$this->breadcrumbs=array(
	'Cobros Obras Sociales'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CobrosObrasSociales', 'url'=>array('index')),
	array('label'=>'Create CobrosObrasSociales', 'url'=>array('create')),
	array('label'=>'Update CobrosObrasSociales', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CobrosObrasSociales', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CobrosObrasSociales', 'url'=>array('admin')),
);
?>

<h1>View CobrosObrasSociales #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idObraSocial',
		'idFactura',
		'idCobro',
	),
)); ?>
