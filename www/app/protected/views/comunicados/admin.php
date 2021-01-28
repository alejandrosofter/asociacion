<?php
$this->breadcrumbs=array(
	'Comunicadoses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar Comunicados', 'url'=>array('index')),
	array('label'=>'Nuevo Comunicados', 'url'=>array('create')),
);


<h1>Administracion Comunicadoses</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'comunicados-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'fecha',
		'mensaje',
		'enviaMail',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
