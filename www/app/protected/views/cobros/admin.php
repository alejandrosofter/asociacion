<?php
$this->breadcrumbs=array(
	'Cobroses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar Cobros', 'url'=>array('index')),
	array('label'=>'Nuevo Cobros', 'url'=>array('create')),
);


<h1>Administracion Cobroses</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cobros-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'fecha',
		'detalle',
		'importe',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
