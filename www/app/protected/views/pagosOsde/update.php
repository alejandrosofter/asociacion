<?php
$this->breadcrumbs=array(
	'Pagos Osdes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar PagosOsde', 'url'=>array('index')),
	array('label'=>'Nuevo PagosOsde', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro PagosOsde <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>