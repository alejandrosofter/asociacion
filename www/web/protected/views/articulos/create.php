<?php
$this->breadcrumbs=array(
	'Articuloses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Articulos', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo Articulos</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>