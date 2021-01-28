<?php
$this->breadcrumbs=array(
	'Profesionales'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Listar Profesionales', 'url'=>array('index')),
	array('label'=>'Nuevo Profesionales', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro Profesionales <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model,'modelUsuario'=>$modelUsuario)); ?>