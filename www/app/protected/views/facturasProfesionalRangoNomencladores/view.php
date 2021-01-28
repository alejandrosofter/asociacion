<?php
$this->breadcrumbs=array(
	'Facturas Profesional Rango Nomencladores'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FacturasProfesionalRangoNomencladores','url'=>array('index')),
	array('label'=>'Create FacturasProfesionalRangoNomencladores','url'=>array('create')),
	array('label'=>'Update FacturasProfesionalRangoNomencladores','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete FacturasProfesionalRangoNomencladores','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FacturasProfesionalRangoNomencladores','url'=>array('admin')),
);
?>

<h1>View FacturasProfesionalRangoNomencladores #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fechaDesde',
		'fechaHasta',
	),
)); ?>
