<?php
$this->breadcrumbs=array(
	'Retenciones'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Retenciones', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo Retenciones</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>