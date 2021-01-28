<?php
$this->breadcrumbs=array(
	'Pagos Tiposes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PagosTipos', 'url'=>array('index')),
	array('label'=>'Create PagosTipos', 'url'=>array('create')),
	array('label'=>'Update PagosTipos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PagosTipos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PagosTipos', 'url'=>array('admin')),
);
?>

<h1>View PagosTipos #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombreTipoPago',
	),
)); ?>
