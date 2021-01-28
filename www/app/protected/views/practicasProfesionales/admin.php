<?php
$this->breadcrumbs=array(
	'Practicas Profesionales'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar PracticasProfesionales', 'url'=>array('index')),
	array('label'=>'Nuevo PracticasProfesionales', 'url'=>array('create')),
);


<h1>Administracion Practicas Profesionales</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'practicas-profesionales-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'fecha',
		'idProfesional',
		'idObraSocial',
		'cantidad',
		'idPractica',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
