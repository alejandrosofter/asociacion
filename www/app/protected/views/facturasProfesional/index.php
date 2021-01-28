<?php
$this->breadcrumbs=array(
	'Facturas Profesionales',
);
$this->menu=array(
	array('label'=>'Nueva Factura', 'url'=>array('create')),
);
?>


<header id="page-header">
<h1 id="page-title"><img src="images/iconos/glyphicons/png/glyphicons-622-businessman.png"/>  FACTURACION A PROFESIONALES <small> busca, observa, elimina...</small></h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'facturas-profesional-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		array(
            'type'=>'html',
            'header'=>'Fecha',
            'value'=>'"<small>".Yii::app()->dateFormatter->format("dd-MM-yyyy",$data->fecha)."</small>"',
            'htmlOptions'=>array('style'=>'width: 90px'),
            ),
		'profesional.nombreProfesionales',
		
		'obraSocial.nombreOs',
		array(
            'type'=>'html',
            'header'=>'Importe',
            'value'=>'"<strong>$ ".Yii::app()->numberFormatter->formatCurrency($data->importe,"")."</strong>"',
            'htmlOptions'=>array('style'=>'width: 90px;text-align: right'),
            ),
		'estado',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
