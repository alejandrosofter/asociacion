<?php
$this->breadcrumbs=array(
	'Tabla Retenciones'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar TablaRetenciones', 'url'=>array('index')),
	array('label'=>'Nuevo TablaRetenciones', 'url'=>array('create')),
);


<h1>Administracion Tabla Retenciones</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tabla-retenciones-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'idImpuesto',
		'masDe',
		'a',
		'agregadoEfectivo',
		'agregadoPorcentaje',
		'exedenteEfectivo',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
