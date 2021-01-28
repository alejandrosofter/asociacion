<?php
$this->breadcrumbs=array(
	'Cobros',
);
$this->menu=array(
	array('label'=>'Nuevo Cobro', 'url'=>array('create')),
);
?>

<header id="page-header">
    
<h1 id="page-title"><img src="images/iconos/glyphicons/png/glyphicons-352-book-open.png"/>  COBROS <small>DE OBRAS SOCIALES</small></h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cobros-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		array(
            'type'=>'html',
            'header'=>'Fecha',
            'value'=>'"<small>".Yii::app()->dateFormatter->format("dd-MM-yyyy",$data->fecha)."</small>"',
            'htmlOptions'=>array('style'=>'width: 70px'),
            ),
		array(
            'type'=>'html',
            'header'=>'DETALLE',
            'value'=>'$data->getDetalleFactura()',
            'htmlOptions'=>array('style'=>'width: 300px;text-align: left'),
            ),
	array(
            'type'=>'html',
            'header'=>'$ Debitos',
            'value'=>'"<strong>$ ".Yii::app()->numberFormatter->formatCurrency($data->importeDebitos,"")."</strong>"',
            'htmlOptions'=>array('style'=>'width: 90px;text-align: right'),
            ),
		array(
            'type'=>'html',
            'header'=>'$ Cobrado',
            'value'=>'"<strong>$ ".Yii::app()->numberFormatter->formatCurrency($data->importe,"")."</strong>"',
            'htmlOptions'=>array('style'=>'width: 90px;text-align: right'),
            ),
		array(
            'type'=>'html',
            'header'=>'ESTADO',
            'value'=>'"<strong style=\'color:".$data->getColor()."\'>".$data->estado."</strong>"',
            'htmlOptions'=>array('style'=>'width: 80px;text-align: right'),
            ),
		array(
	 'htmlOptions'=>array('style'=>'width:70px;text-align: right'),
			'class'=>'CButtonColumn' ,'template'=>' {ver} {delete}','buttons'=>array(
'ver' => array(
                
                'label'=>'Ver ITEMS DEL COBRO',
                'imageUrl'=>'images/iconos/famfam/folder.png',
                'url' => '"index.php?r=cobrosItems/index&id=".$data->id',

            ),
	'verFactura' => array(
                
                'label'=>'Ver Factura',
                'imageUrl'=>'images/iconos/famfam/report.png',
                'url' => '"index.php?r=facturasObrasSocial/imprimirResumen&idFactura=".$data->cobroOs->idFactura',
								'visible'=>'isset($data->cobroOs->idFactura)?true:false'
            ),
'renombrar' => array(
                
                'label'=>'Recalcular Importe',
                'imageUrl'=>'images/iconos/famfam/wand.png',
                'url' => '"index.php?r=cobros/recalculaImporte&id=".$data->id',

            ),
				)
		),
	),
)); ?>
