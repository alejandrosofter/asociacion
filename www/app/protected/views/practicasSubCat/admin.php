<?php
$this->breadcrumbs=array(
	'Practicas Sub Cats'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar PracticasSubCat', 'url'=>array('index')),
	array('label'=>'Nuevo PracticasSubCat', 'url'=>array('create')),
);


<h1>Administracion Practicas Sub Cats</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'practicas-sub-cat-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombreSubCat',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
