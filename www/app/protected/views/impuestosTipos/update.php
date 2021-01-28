<?php
$this->breadcrumbs=array(
	'Impuestos Tiposes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar ImpuestosTipos', 'url'=>array('index')),
	array('label'=>'Nuevo ImpuestosTipos', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro ImpuestosTipos <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>