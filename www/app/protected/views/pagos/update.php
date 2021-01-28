<?php
$this->breadcrumbs=array(
	'Pagoses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Pagos', 'url'=>array('index')),
	array('label'=>'Nuevo Pagos', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro Pagos <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>