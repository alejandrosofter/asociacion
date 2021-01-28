<?php
$this->breadcrumbs=array(
	'Pagos Tiposes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar PagosTipos', 'url'=>array('index')),
	array('label'=>'Nuevo PagosTipos', 'url'=>array('create')),
);


<h1>Administracion Pagos Tiposes</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pagos-tipos-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombreTipoPago',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
