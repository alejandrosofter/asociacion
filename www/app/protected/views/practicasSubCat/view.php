<?php
$this->breadcrumbs=array(
	'Practicas Sub Cats'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PracticasSubCat', 'url'=>array('index')),
	array('label'=>'Create PracticasSubCat', 'url'=>array('create')),
	array('label'=>'Update PracticasSubCat', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PracticasSubCat', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PracticasSubCat', 'url'=>array('admin')),
);
?>

<h1>View PracticasSubCat #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombreSubCat',
	),
)); ?>
