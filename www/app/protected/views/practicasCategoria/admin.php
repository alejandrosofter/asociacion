<?php
$this->breadcrumbs=array(
	'Practicas Categorias'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar PracticasCategoria', 'url'=>array('index')),
	array('label'=>'Nuevo PracticasCategoria', 'url'=>array('create')),
);


<h1>Administracion Practicas Categorias</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'practicas-categoria-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombreCategoria',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
