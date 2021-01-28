<?php
$this->breadcrumbs=array(
	'Pagos Tiposes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar PagosTipos', 'url'=>array('index')),
	array('label'=>'Nuevo PagosTipos', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro PagosTipos <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>