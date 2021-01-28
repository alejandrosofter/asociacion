<?php
$this->breadcrumbs=array(
	'Retenciones Detalles',
);
$this->menu=array(
	array('label'=>'Nuevo RetencionesDetalle', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración Retenciones Detalles</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'retenciones-detalle-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'id',
		'idPago',
		'detalle',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
