<?php
$this->breadcrumbs=array(
	'Obras Sociales'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar ObrasSociales', 'url'=>array('index')),
	array('label'=>'Nuevo ObrasSociales', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro ObrasSociales <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>