<?php
$this->breadcrumbs=array(
	'Pagos'=>array('/pagos'),'Items'
);
$this->menu=array(
	array('label'=>'Nuevo Item', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Items del Pago</h1>
</header>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pagos-items-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		
		'detalle',
		'tipo.nombreTipoCobro',
		array(
            'type'=>'html',
            'header'=>'Importe',
            'value'=>'"<strong>$ ".Yii::app()->numberFormatter->formatCurrency($data->importe,"")."</strong>"',
            'htmlOptions'=>array('style'=>'width: 90px;text-align: right'),
            ),
		array(
			'class'=>'CButtonColumn','template'=>'{retencion} {delete}','buttons'=>array(
				'retencion' => array(
                'label'=>'Retencion',
                'imageUrl'=>'images/iconos/famfam/asterisk_orange.png',
                'visible'=>'$data->idTipoItemPago==PagosItems::ID_TIPO_IMPUESTORETENCION',
                'url' => '"index.php?r=retenciones/mostrarRetencion&id=".$data->idPago',

            ),
				)
		),
	),
)); ?>
