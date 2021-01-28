<?php
$this->breadcrumbs=array(
	'Pagos'=>array('/pagos'),
	'Tipos'
);
$this->menu=array(
	array('label'=>'Nuevo Tipo', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración de Tipo de Pago</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pagos-tipos-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(

		'nombreTipoPago',
		array(
			'class'=>'CButtonColumn','template'=>'{items} {delete}','buttons'=>array(
				'items' => array(
                'label'=>'Tipo de Cobros',
                'imageUrl'=>'images/iconos/famfam/asterisk_orange.png',
                'url' => '"index.php?r=pagosTiposCobros/index&id=".$data->id',

            ),
				)
		),
	),
)); ?>
