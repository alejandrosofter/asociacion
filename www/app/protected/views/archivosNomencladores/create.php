<?php
$this->breadcrumbs=array(
	'Nomencladores'=>array('index'),
	'Nuevo',
);

?>

<h1>Nuevo <b>NOMENCLADOR</b></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>