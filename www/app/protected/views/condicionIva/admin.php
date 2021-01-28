<?php
$this->breadcrumbs=array(
	'Condicion Ivas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar CondicionIva', 'url'=>array('index')),
	array('label'=>'Nuevo CondicionIva', 'url'=>array('create')),
);


<h1>Administracion Condicion Ivas</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'condicion-iva-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombreIva',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
