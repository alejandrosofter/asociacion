<?php
$this->breadcrumbs=array(
	'Retenciones',
);
$this->menu=array(
	array('label'=>'Nueva Retencion', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración de Retenciones</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'retenciones-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'idPago',
		'importeRetencion',
		'importeBase',
		'idTablaRetencion',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
