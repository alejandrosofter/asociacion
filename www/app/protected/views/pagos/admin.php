<?php
$this->breadcrumbs=array(
	'Pagoses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar Pagos', 'url'=>array('index')),
	array('label'=>'Nuevo Pagos', 'url'=>array('create')),
);


<h1>Administracion Pagoses</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pagos-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'idProfesional',
		'importe',
		'fecha',
		'estado',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
