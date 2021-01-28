<?php
$this->breadcrumbs=array(
	'Profesionales'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar Profesionales', 'url'=>array('index')),
	array('label'=>'Nuevo Profesionales', 'url'=>array('create')),
);


<h1>Administracion Profesionales</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'profesionales-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombre',
		'apellido',
		'email',
		'telefono',
		'idCondicionIva',
		/*
		'cuit',
		'dni',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
