<?php
$this->breadcrumbs=array(
	'Facturas Obra Social'=>array('/FacturasObrasSocial'),
	'Items'
);
$this->menu=array(
	array('label'=>'Nuevo FacturasObrasSocialItems', 'url'=>array('create')),
);
?>

<header id="page-header">

<h1 id="page-title">Items de Factura</h1>
</header>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'facturas-obras-social-items-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'facturaProfesional.profesional.nombreProfesionales',
		array(
            'type'=>'html',
            'header'=>'Importe',
            'value'=>'"<strong>$ ".Yii::app()->numberFormatter->formatCurrency($data->facturaProfesional->importe,"")."</strong>"',
            'htmlOptions'=>array('style'=>'width: 90px;text-align: right'),
            ),
		'facturaProfesional.estado',
		array(
			'class'=>'CButtonColumn','template'=>'{update} {delete}',
				
		),
		
	),
)); ?>
