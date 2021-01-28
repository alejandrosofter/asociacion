<?php
$this->breadcrumbs=array(
	'Facturas Obras Social Items'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FacturasObrasSocialItems', 'url'=>array('index')),
	array('label'=>'Create FacturasObrasSocialItems', 'url'=>array('create')),
	array('label'=>'Update FacturasObrasSocialItems', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FacturasObrasSocialItems', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FacturasObrasSocialItems', 'url'=>array('admin')),
);
?>

<h1>View FacturasObrasSocialItems #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idFacturaObraSocial',
		'idFacturaProfesional',
	),
)); ?>
