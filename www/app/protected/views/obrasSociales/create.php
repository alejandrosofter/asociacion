<?php
$this->breadcrumbs=array(
	'Obras Sociales'=>array('index'),
	'Nueva',
);

$this->menu=array(
	array('label'=>'Listar ObrasSociales', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nueva OBRA SOCIAL</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>