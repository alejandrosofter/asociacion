<?php
$this->breadcrumbs=array(
	'Nomencladores'=>array('index'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Nomencladores','url'=>array('index')),
);
?>

<h1>Nuevo Nomenclador</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>