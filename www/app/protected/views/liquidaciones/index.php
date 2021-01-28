<?php
$this->breadcrumbs=array(
	'Liquidaciones',
);
$this->menu=array(
	//array('label'=>'Nuevo Pago', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title"><img src="images/iconos/glyphicons/png/glyphicons-381-message-forward.png"/>  PAGOS AGRUPADOS POR OS <small>A PROFESIONALES</small></h1>
</header>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'liquidaciones-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		array(
            'type'=>'html',
            'header'=>'Fecha',
            'value'=>'"<small>".Yii::app()->dateFormatter->format("dd-MM-yyyy",$data->fecha)."</small>"',
            'htmlOptions'=>array('style'=>'width: 90px'),
            ),
		array(
            'type'=>'html',
            'header'=>'Que Os Liquido?',
            'value'=>'"<strong> ".$data->getOsLiquido()."</strong>"',
            ),
        array(
            'type'=>'html',
            'header'=>'Importe',
            'value'=>'"<strong>$ ".Yii::app()->numberFormatter->formatCurrency($data->importe,"")."</strong>"',
            'htmlOptions'=>array('style'=>'width: 120px;text-align: left'),
            ),
		array(
  'htmlOptions'=>array('style'=>'width: 120px'),
			'class'=>'CButtonColumn','template'=>'{verPagos} {retencion} {imprimir} {enviarMail} {delete}','htmlOptions'=>array('style'=>'width:100px')
            ,'buttons'=>array(
                'imprimir' => array(
                'label'=>'Imprimir',
                'imageUrl'=>'images/iconos/famfam/printer.png',
                'url' => '"index.php?r=liquidaciones/exportar&id=".$data->id',
          //      'options'=>array('class'=>'imprime','data-fancybox-type'=>'iframe'),

            ),
	 'retencion' => array(
                'label'=>'Comprobante Retención',
                'imageUrl'=>'images/iconos/famfam/page_white_star.png',
                'url' => '"index.php?r=liquidaciones/exportar&id=".$data->id."&retencion=true"',
                //'options'=>array('class'=>'imprime','data-fancybox-type'=>'iframe'),

            ),
   'enviarMail' => array(
                'label'=>'Envio de Mails',
                'imageUrl'=>'images/iconos/famfam/email.png',
                'url' => '"index.php?r=liquidaciones/mails&id=".$data->id',
                'options'=>array('class'=>'imprime','data-fancybox-type'=>'iframe'),

            ),
				'verPagos' => array(
                'label'=>'Ver pagos imputados',
                'imageUrl'=>'images/iconos/famfam/money.png',
                'url' => '"index.php?r=pagos/verPagosLiquidacion&id=".$data->id',

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
