<?php
$this->breadcrumbs=array(
	'Facturas Profesionals'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar FacturasProfesional', 'url'=>array('index')),
	array('label'=>'Nuevo FacturasProfesional', 'url'=>array('create')),
);


<h1>Administracion Facturas Profesionals</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'facturas-profesional-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'fecha',
		'fechaUpdate',
		'idProfesional',
		'importe',
		'idObraSocial',
		/*
		'estado',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
