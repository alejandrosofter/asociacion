<?php
$this->breadcrumbs=array(
	'Tabla Retenciones'=>array('index'),
	$model->idImpuesto=>array('view','id'=>$model->idImpuesto),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar TablaRetenciones', 'url'=>array('index')),
	array('label'=>'Nuevo TablaRetenciones', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro TablaRetenciones <?php echo $model->idImpuesto; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>