<?php
$this->breadcrumbs=array(
	'Facturas Obras Socials'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FacturasObrasSocial', 'url'=>array('index')),
	array('label'=>'Create FacturasObrasSocial', 'url'=>array('create')),
	array('label'=>'Update FacturasObrasSocial', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FacturasObrasSocial', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FacturasObrasSocial', 'url'=>array('admin')),
);
?>

<h1>View FacturasObrasSocial #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha',
		'idObraSocial',
		'importe',
		'estado',
		'detalle',
	),
)); ?>
