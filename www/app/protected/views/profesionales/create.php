<?php
$this->breadcrumbs=array(
	'Profesionales'=>array('index'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Listar Profesionales', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo PROFESIONAL</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model,'modelUsuario'=>$modelUsuario)); ?>