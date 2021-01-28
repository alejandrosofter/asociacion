<?php
$this->breadcrumbs=array(
	'Obras Sociales'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar ObrasSociales', 'url'=>array('index')),
	array('label'=>'Nuevo ObrasSociales', 'url'=>array('create')),
);


<h1>Administracion Obras Sociales</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'obras-sociales-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombreOs',
		'email',
		'contacto',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
