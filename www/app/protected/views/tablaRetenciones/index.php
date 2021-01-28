<?php
$this->breadcrumbs=array(
	'Tabla de Retenciones',
);
$this->menu=array(
	array('label'=>'Nuevo TablaRetenciones', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Tabla de Retenciones</h1>
</header>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tabla-retenciones-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
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
