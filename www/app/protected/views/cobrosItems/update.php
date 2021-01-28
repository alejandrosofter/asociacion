<?php
$this->breadcrumbs=array(
	'Cobros Items'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar CobrosItems', 'url'=>array('index')),
	array('label'=>'Nuevo CobrosItems', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro CobrosItems <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>