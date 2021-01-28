<?php
$this->breadcrumbs=array(
	'Pagos Tipos Cobroses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar PagosTiposCobros', 'url'=>array('index')),
	array('label'=>'Nuevo PagosTiposCobros', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro PagosTiposCobros <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>