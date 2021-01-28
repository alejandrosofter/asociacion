<?php
$this->breadcrumbs=array(
	'Practicas Profesionales'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar PracticasProfesionales', 'url'=>array('index')),
	array('label'=>'Nuevo PracticasProfesionales', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro PracticasProfesionales <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>