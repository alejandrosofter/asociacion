<?php
$this->breadcrumbs=array(
	'Facturas Obras Social Items'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar FacturasObrasSocialItems', 'url'=>array('index')),
	array('label'=>'Nuevo FacturasObrasSocialItems', 'url'=>array('create')),
);


<h1>Administracion Facturas Obras Social Items</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'facturas-obras-social-items-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'idFacturaObraSocial',
		'idFacturaProfesional',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
