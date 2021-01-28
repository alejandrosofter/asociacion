<?php
$this->breadcrumbs=array(
	'Facturas Obras Social Items'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar FacturasObrasSocialItems', 'url'=>array('index')),
	array('label'=>'Nuevo FacturasObrasSocialItems', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro FacturasObrasSocialItems <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>