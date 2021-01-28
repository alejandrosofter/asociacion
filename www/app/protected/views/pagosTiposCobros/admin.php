<?php
$this->breadcrumbs=array(
	'Pagos Tipos Cobroses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar PagosTiposCobros', 'url'=>array('index')),
	array('label'=>'Nuevo PagosTiposCobros', 'url'=>array('create')),
);


<h1>Administracion Pagos Tipos Cobroses</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pagos-tipos-cobros-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'idTipoPago',
		'idTipoCobro',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
