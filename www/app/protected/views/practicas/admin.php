<?php
$this->breadcrumbs=array(
	'Practicases'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar Practicas', 'url'=>array('index')),
	array('label'=>'Nuevo Practicas', 'url'=>array('create')),
);


<h1>Administracion Practicases</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'practicas-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'codigo',
		'descripcion',
		'idCategoria',
		'idSubCategoria',
		'codigoObraSocial',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
