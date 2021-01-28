<?php
$this->breadcrumbs=array(
	'Profesionales Usuarioses',
);
$this->menu=array(
	array('label'=>'Nuevo ProfesionalesUsuarios', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración Profesionales Usuarioses</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'profesionales-usuarios-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'id',
		'idProfesional',
		'idUsuario',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
