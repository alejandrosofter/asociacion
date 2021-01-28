<?php
$this->breadcrumbs=array(
	'Tabla Retenciones'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar TablaRetenciones', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo TablaRetenciones</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>