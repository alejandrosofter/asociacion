<?php
$this->breadcrumbs=array(
	'Tabla Retenciones'=>array('index'),
	$model->idImpuesto,
);

$this->menu=array(
	array('label'=>'List TablaRetenciones', 'url'=>array('index')),
	array('label'=>'Create TablaRetenciones', 'url'=>array('create')),
	array('label'=>'Update TablaRetenciones', 'url'=>array('update', 'id'=>$model->idImpuesto)),
	array('label'=>'Delete TablaRetenciones', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idImpuesto),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TablaRetenciones', 'url'=>array('admin')),
);
?>

<h1>View TablaRetenciones #<?php echo $model->idImpuesto; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idImpuesto',
		'masDe',
		'a',
		'agregadoEfectivo',
		'agregadoPorcentaje',
		'exedenteEfectivo',
	),
)); ?>
