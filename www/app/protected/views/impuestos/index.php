<?php
$this->breadcrumbs=array(
	'Impuestos',
);
$this->menu=array(
	array('label'=>'Nuevo Impuestos', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración de Impuestos</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'impuestos-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'nombreImpuesto',
		array('header'=>'Porcentaje','value'=>'($data->porcentaje*100)." %"'),
		'descripcion',
		array('header'=>'Es Retencion?','value'=>'($data->esRetencion?"si":"no")'),
		array(
			'class'=>'CButtonColumn','template'=>'{items} {update} {delete}','buttons'=>array(
				'items' => array(
                'label'=>'Tipos en impuesto',
                'imageUrl'=>'images/iconos/famfam/bullet_arrow_down.png',
                'url' => '"index.php?r=impuestosTipos/index&id=".$data->id',

            ),
				)
		),
	),
)); ?>
