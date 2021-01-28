<?php
$this->breadcrumbs=array(
	'Comunicados'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Listar Comunicados', 'url'=>array('index')),
	array('label'=>'Nuevo Comunicados', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro Comunicados <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>