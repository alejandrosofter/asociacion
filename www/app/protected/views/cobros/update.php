<?php
$this->breadcrumbs=array(
	'Cobroses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Cobros', 'url'=>array('index')),
	array('label'=>'Nuevo Cobros', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro Cobros <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model,'modelObra'=>$modelObra)); ?>