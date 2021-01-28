<?php
$this->breadcrumbs=array(
	'Pagos'=>array('/pagos'),
	'Tipos'=>array('/pagosTipos'),
	'Cobros a Cargo',
);
$this->menu=array(
	array('label'=>'Nuevo Cobro', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración de Cobros a Cargo</h1>
</header>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pagos-tipos-cobros-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'tipoPago.nombreTipoPago',
		'tipoCobro.nombreTipoCobro',
		
		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
