<?php
$this->breadcrumbs=array(
	'Cobros Items'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar CobrosItems', 'url'=>array('index')),
	array('label'=>'Nuevo CobrosItems', 'url'=>array('create')),
);


<h1>Administracion Cobros Items</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cobros-items-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'idCobro',
		'detalle',
		'importe',
		'idTipoItem',
		'estado',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
