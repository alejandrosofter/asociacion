<?php
$this->breadcrumbs=array(
	'Articuloses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Articulos', 'url'=>array('index')),
	array('label'=>'Nuevo Articulos', 'url'=>array('create')),
);
?>
<header id="page-header">

</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>