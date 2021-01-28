<?php
$this->breadcrumbs=array(
	'Retenciones Detalles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar RetencionesDetalle', 'url'=>array('index')),
	array('label'=>'Nuevo RetencionesDetalle', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro RetencionesDetalle <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>