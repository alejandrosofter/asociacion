<?php
$this->breadcrumbs=array(
	'Profesionales Usuarioses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar ProfesionalesUsuarios', 'url'=>array('index')),
	array('label'=>'Nuevo ProfesionalesUsuarios', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro ProfesionalesUsuarios <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>