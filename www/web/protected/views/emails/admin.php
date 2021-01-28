<?php
$this->breadcrumbs=array(
	'Emails'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar Emails', 'url'=>array('index')),
	array('label'=>'Nuevo Emails', 'url'=>array('create')),
);


<h1>Administracion Emails</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'emails-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'mensaje',
		'remitente',
		'fecha',
		'estado',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
