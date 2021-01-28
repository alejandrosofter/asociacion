<?php
$this->breadcrumbs=array(
	'NOTAS DE CREDITO'=>array('index'),
	'Nuevo',
);

?>

<h1>Nueva <b>NOTA DE CREDITO (AFIP)</b></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>