<?php
$this->breadcrumbs=array(
	'Facturas Profesional Nomencladores'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FacturasProfesionalNomencladores','url'=>array('index')),
	array('label'=>'Create FacturasProfesionalNomencladores','url'=>array('create')),
	array('label'=>'Update FacturasProfesionalNomencladores','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete FacturasProfesionalNomencladores','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FacturasProfesionalNomencladores','url'=>array('admin')),
);
?>

<h1>View FacturasProfesionalNomencladores #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'codigoInterno',
		'codigoExterno',
		'detalle',
		'importe',
	),
)); ?>
