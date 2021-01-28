<?php
$this->breadcrumbs=array(
	'Impuestos Tiposes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ImpuestosTipos', 'url'=>array('index')),
	array('label'=>'Create ImpuestosTipos', 'url'=>array('create')),
	array('label'=>'Update ImpuestosTipos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ImpuestosTipos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ImpuestosTipos', 'url'=>array('admin')),
);
?>

<h1>View ImpuestosTipos #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idTipoCobro',
		'idImpuesto',
	),
)); ?>
