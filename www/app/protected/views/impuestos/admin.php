<?php
$this->breadcrumbs=array(
	'Impuestoses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar Impuestos', 'url'=>array('index')),
	array('label'=>'Nuevo Impuestos', 'url'=>array('create')),
);


<h1>Administracion Impuestoses</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'impuestos-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombreImpuesto',
		'porcentaje',
		'descripcion',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
