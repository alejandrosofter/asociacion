<?php
$this->breadcrumbs=array(
	'Cobros Tiposes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar CobrosTipos', 'url'=>array('index')),
	array('label'=>'Nuevo CobrosTipos', 'url'=>array('create')),
);


<h1>Administracion Cobros Tiposes</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cobros-tipos-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombreTipoCobro',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
