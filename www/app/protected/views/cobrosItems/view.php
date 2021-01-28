<?php
$this->breadcrumbs=array(
	'Cobros Items'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CobrosItems', 'url'=>array('index')),
	array('label'=>'Create CobrosItems', 'url'=>array('create')),
	array('label'=>'Update CobrosItems', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CobrosItems', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CobrosItems', 'url'=>array('admin')),
);
?>

<h1>View CobrosItems #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idCobro',
		'detalle',
		'importe',
		'idTipoItem',
		'estado',
	),
)); ?>
