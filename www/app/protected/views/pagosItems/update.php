<?php
$this->breadcrumbs=array(
	'Pagos Items'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar PagosItems', 'url'=>array('index')),
	array('label'=>'Nuevo PagosItems', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro PagosItems <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>