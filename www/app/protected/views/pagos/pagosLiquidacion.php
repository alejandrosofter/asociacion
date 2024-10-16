<?php
$this->breadcrumbs=array(
	'Pagos Liquidacion',
);

?>

<header id="page-header">
<h1 id="page-title">PAGOS DE LA LIQUIDACION</h1>
</header>

<?


?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pagos-grid',
	'dataProvider'=>$model->pagosLiquidacion($_GET['id']),
	
	'columns'=>array(
		array(
            'type'=>'html',
            'header'=>'Fecha',
            'value'=>'"<small>".Yii::app()->dateFormatter->format("dd-MM-yyyy",$data->fecha)."</small>"',
            'htmlOptions'=>array('style'=>'width: 90px'),
            ),
		'profesional.nombreProfesionales',
		array(
            'type'=>'html',
            'header'=>'Retiene?',
            'value'=>'"<strong> ".($data->noRetiene==1?"NO":"SI")."</strong>"',
            'htmlOptions'=>array('style'=>'width: 90px;text-align: right'),
            ),
        array(
            'type'=>'html',
            'header'=>'Importe',
            'value'=>'"<strong>$ ".Yii::app()->numberFormatter->formatCurrency($data->importe,"")."</strong>"',
            'htmlOptions'=>array('style'=>'width: 90px;text-align: right'),
            ),
		array(
			'class'=>'CButtonColumn','template'=>'{mail} {retencion} {detalleRetencion} {pago} {delete}','htmlOptions'=>array('style'=>'width:120px')
            ,'buttons'=>array(
              'mail' => array(
                'label'=>'Enviar Pago',
                'imageUrl'=>'images/iconos/famfam/email.png',
                'url' => '"index.php?r=pagos/enviarPagoIndividual&id=".$data->id',
                'options'=>array('class'=>'imprime','data-fancybox-type'=>'iframe'),

            ), 
                'retencion' => array(
                'label'=>'Comprobante Retenciónnn',
                'visible'=>'isset($data->retencion)',
                'imageUrl'=>'images/iconos/famfam/page_white_star.png',
                'url' => '"index.php?r=pagos/imprimirRetencion&id=".$data->id',
                'options'=>array('class'=>'imprime','data-fancybox-type'=>'iframe'),

            ),
				'pago' => array(
                'label'=>'Comprobante Pagoooo',
                'imageUrl'=>'images/iconos/famfam/page_red.png',
                'url' => '"index.php?r=pagos/imprimirPago&id=".$data->id',
                'options'=>array('class'=>'imprime','data-fancybox-type'=>'iframe'),

            ),
                'detalleRetencion' => array(
                'label'=>'Detalle RET',
                'visible'=>'isset($data->retencion)',
                'imageUrl'=>'images/iconos/famfam/report_key.png',
                'url' => '"index.php?r=pagos/detalleRetencion&id=".$data->id',
                'options'=>array('class'=>'imprime','data-fancybox-type'=>'iframe'),

            ),
				'ver' => array(
                'label'=>'Ver',
                'imageUrl'=>'images/iconos/famfam/zoom.png',
                'url' => '"index.php?r=pagosItems/ver&id=".$data->id',

            ),
                'liquida' => array(
                'label'=>'liquida',
                'imageUrl'=>'images/iconos/famfam/1.png',
                'url' => '"index.php?r=pagos/liquida&id=".$data->id',

            ),
			)
		),
	),
)); ?>
