<?php
$this->breadcrumbs=array(
	'Retenciones'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar Retenciones', 'url'=>array('index')),
	array('label'=>'Nuevo Retenciones', 'url'=>array('create')),
);


<h1>Administracion Retenciones</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'retenciones-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'idPago',
		'importeRetencion',
		'importeBase',
		'idTablaRetencion',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
