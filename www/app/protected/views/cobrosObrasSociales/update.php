<?php
$this->breadcrumbs=array(
	'Cobros Obras Sociales'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar CobrosObrasSociales', 'url'=>array('index')),
	array('label'=>'Nuevo CobrosObrasSociales', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro CobrosObrasSociales <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model,'modelObra'=>$modelObra)); ?>