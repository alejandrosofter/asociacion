<?php
$this->breadcrumbs=array(
	'Articuloses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar Articulos', 'url'=>array('index')),
	array('label'=>'Nuevo Articulos', 'url'=>array('create')),
);


<h1>Administracion Articuloses</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'articulos-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'titulo',
		'contenido',
		'fechaUpdate',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
