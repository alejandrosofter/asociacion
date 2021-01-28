<?php
$this->breadcrumbs=array(
	'Cobros Obras Sociales',
);
$this->menu=array(
	array('label'=>'Nuevo CobrosObrasSociales', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración Cobros Obras Sociales</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cobros-obras-sociales-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'id',
		'idObraSocial',
		'idFactura',
		'idCobro',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
