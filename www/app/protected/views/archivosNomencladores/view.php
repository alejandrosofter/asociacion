<?php
$this->breadcrumbs=array(
	'Archivos Nomencladores'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ArchivosNomencladores','url'=>array('index')),
	array('label'=>'Create ArchivosNomencladores','url'=>array('create')),
	array('label'=>'Update ArchivosNomencladores','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ArchivosNomencladores','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ArchivosNomencladores','url'=>array('admin')),
);
?>

<h1>View ArchivosNomencladores #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idObraSocial',
		'fechaModificacion',
		'data',
	),
)); ?>
