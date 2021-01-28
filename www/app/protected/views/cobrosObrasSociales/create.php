<?php
$this->breadcrumbs=array(
	'Cobros Obras Sociales'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar CobrosObrasSociales', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo CobrosObrasSociales</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model,'modelObra'=>$modelObra)); ?>