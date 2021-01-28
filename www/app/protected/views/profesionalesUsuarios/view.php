<?php
$this->breadcrumbs=array(
	'Profesionales Usuarioses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ProfesionalesUsuarios', 'url'=>array('index')),
	array('label'=>'Create ProfesionalesUsuarios', 'url'=>array('create')),
	array('label'=>'Update ProfesionalesUsuarios', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProfesionalesUsuarios', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProfesionalesUsuarios', 'url'=>array('admin')),
);
?>

<h1>View ProfesionalesUsuarios #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idProfesional',
		'idUsuario',
	),
)); ?>
