<?php
$this->breadcrumbs=array(
	'Pagos Items'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar PagosItems', 'url'=>array('index')),
	array('label'=>'Nuevo PagosItems', 'url'=>array('create')),
);


<h1>Administracion Pagos Items</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pagos-items-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'idPago',
		'importe',
		'detalle',
		'idTipoItemPago',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
