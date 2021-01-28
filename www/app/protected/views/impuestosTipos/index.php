<?php
$this->breadcrumbs=array(
	'Impuestos'=>array('/impuestos'),
	'Tipos'
);
$this->menu=array(
	array('label'=>'Nuevo Tipo', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Tipos</h1>
</header>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'impuestos-tipos-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'tipo.nombreTipoCobro',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
