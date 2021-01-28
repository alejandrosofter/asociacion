<?php
$this->breadcrumbs=array(
	'Pagos Tipos Cobroses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PagosTiposCobros', 'url'=>array('index')),
	array('label'=>'Create PagosTiposCobros', 'url'=>array('create')),
	array('label'=>'Update PagosTiposCobros', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PagosTiposCobros', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PagosTiposCobros', 'url'=>array('admin')),
);
?>

<h1>View PagosTiposCobros #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idTipoPago',
		'idTipoCobro',
	),
)); ?>
