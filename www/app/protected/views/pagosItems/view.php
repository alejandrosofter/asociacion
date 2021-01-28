<?php
$this->breadcrumbs=array(
	'Pagos Items'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PagosItems', 'url'=>array('index')),
	array('label'=>'Create PagosItems', 'url'=>array('create')),
	array('label'=>'Update PagosItems', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PagosItems', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PagosItems', 'url'=>array('admin')),
);
?>

<h1>View PagosItems #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idPago',
		'importe',
		'detalle',
		'idTipoItemPago',
	),
)); ?>
