<?php
$this->breadcrumbs=array(
	'Impuestoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Impuestos', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo Impuesto</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>