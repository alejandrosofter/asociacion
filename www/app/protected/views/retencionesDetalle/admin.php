<?php
$this->breadcrumbs=array(
	'Retenciones Detalles'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar RetencionesDetalle', 'url'=>array('index')),
	array('label'=>'Nuevo RetencionesDetalle', 'url'=>array('create')),
);


<h1>Administracion Retenciones Detalles</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'retenciones-detalle-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'idPago',
		'detalle',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
