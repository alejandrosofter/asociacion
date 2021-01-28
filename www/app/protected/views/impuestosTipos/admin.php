<?php
$this->breadcrumbs=array(
	'Impuestos Tiposes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar ImpuestosTipos', 'url'=>array('index')),
	array('label'=>'Nuevo ImpuestosTipos', 'url'=>array('create')),
);


<h1>Administracion Impuestos Tiposes</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'impuestos-tipos-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'idTipoCobro',
		'idImpuesto',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
