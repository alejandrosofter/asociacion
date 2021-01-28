<?php
$this->breadcrumbs=array(
	'Articulos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Listar Articulos', 'url'=>array('index')),
	array('label'=>'Nuevo Articulos', 'url'=>array('create')),
);
?>
<header id="page-header">

</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>