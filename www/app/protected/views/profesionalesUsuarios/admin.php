<?php
$this->breadcrumbs=array(
	'Profesionales Usuarioses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar ProfesionalesUsuarios', 'url'=>array('index')),
	array('label'=>'Nuevo ProfesionalesUsuarios', 'url'=>array('create')),
);


<h1>Administracion Profesionales Usuarioses</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'profesionales-usuarios-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'idProfesional',
		'idUsuario',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
