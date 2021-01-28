<?php
$this->breadcrumbs=array(
	'Facturas LIQUIDACION',
);
$this->menu=array(
	
);
?>

<header id="page-header">
<h1 id="page-title"><b>FACTURAS</b> liquidacion</h1>
</header>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mail-grid',
	'dataProvider'=>$model->buscarFacturas($_GET['id']),
	
	'columns'=>array(
	   array(
            'type'=>'html',
            'header'=>'Fecha',
            'value'=>'"<small>".Yii::app()->dateFormatter->format("dd-MM-yyyy",$data->factura->fechaConsulta)."</small>"',
            'htmlOptions'=>array('style'=>'width: 90px'),
            ),
       'factura.profesional.nombreProfesionales',
        
        'factura.obraSocial.nombreOs',
        'factura.paciente',
        'factura.nomenclador.codigoInterno',
        'factura.estado',
	array(
            'type'=>'html',
            'header'=>'Importe',
            'value'=>'"<strong>$ ".Yii::app()->numberFormatter->formatCurrency($data->factura->importe,"")."</strong>"',
            'htmlOptions'=>array('style'=>'width: 90px;text-align: right'),
            ),
		
		array(
			'class'=>'CButtonColumn','template'=>'{update}','buttons'=>array(
'update' => array(
                
                'label'=>'Editar',
                'url' => '"index.php?r=facturasProfesional/update&id=".$data->idFacturaProfesional',

            ),
)
		),
	),
)); ?>
