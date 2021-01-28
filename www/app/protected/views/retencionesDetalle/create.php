<?php
$this->breadcrumbs=array(
	'Retenciones Detalles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar RetencionesDetalle', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo RetencionesDetalle</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>