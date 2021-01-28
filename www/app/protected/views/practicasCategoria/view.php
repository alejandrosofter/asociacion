<?php
$this->breadcrumbs=array(
	'Practicas Categorias'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PracticasCategoria', 'url'=>array('index')),
	array('label'=>'Create PracticasCategoria', 'url'=>array('create')),
	array('label'=>'Update PracticasCategoria', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PracticasCategoria', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PracticasCategoria', 'url'=>array('admin')),
);
?>

<h1>View PracticasCategoria #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombreCategoria',
	),
)); ?>
