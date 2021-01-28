<?php
$this->breadcrumbs=array(
	'Rango de Nomencladores'=>array('index'),
	'Nuevo',
);


?>

<h1>Modificar RANGO NOMENCLADOR <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>