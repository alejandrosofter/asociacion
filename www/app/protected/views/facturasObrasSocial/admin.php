<?php
$this->breadcrumbs=array(
	'Facturas Obras Socials'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar FacturasObrasSocial', 'url'=>array('index')),
	array('label'=>'Nuevo FacturasObrasSocial', 'url'=>array('create')),
);


<h1>Administracion Facturas Obras Socials</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'facturas-obras-social-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'fecha',
		'idObraSocial',
		'importe',
		'estado',
		'detalle',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
