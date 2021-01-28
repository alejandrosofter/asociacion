<?php
$this->breadcrumbs=array(
	'Cobros Obras Sociales'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar CobrosObrasSociales', 'url'=>array('index')),
	array('label'=>'Nuevo CobrosObrasSociales', 'url'=>array('create')),
);


<h1>Administracion Cobros Obras Sociales</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cobros-obras-sociales-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'idObraSocial',
		'idFactura',
		'idCobro',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
