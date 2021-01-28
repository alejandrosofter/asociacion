<?php
$this->breadcrumbs=array(
	'Prácticas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Prácticas', 'url'=>array('index')),
	array('label'=>'Nuevo Prácticas', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>