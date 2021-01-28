<?php
$this->breadcrumbs=array(
	'Notas Credito',
);
$this->menu=array(
	array('label'=>'Nueva Nota de Credito', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Notas de DEBITO/CREDITO</h1>
</header>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cobros-grid',
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
            'header'=>'Obra Social',
            'value'=>'$data->obraSocial->nombreOs',
            'htmlOptions'=>array('style'=>'width: 290px'),
            ),
array(
            'type'=>'html',
            'header'=>'Cargo Afip',
            'value'=>'$data->cargoAfip()?"SI":"NO"',
            'htmlOptions'=>array('style'=>'width: 120px'),
            ),
array(
            'type'=>'html',
            'header'=>'CAE',
            'value'=>'$data->codigo',
            'htmlOptions'=>array('style'=>'width: 120px'),
            ),
array(
            'type'=>'html',
            'header'=>'Tipo Comprobante',
            'value'=>'$data->tipoComprobanteElectronico->nombre',
            'htmlOptions'=>array('style'=>'width: 120px'),
            ),
		array(
            'type'=>'html',
            'header'=>'$  IMPORTE',
            'value'=>'Yii::app()->numberFormatter->formatCurrency($data->importe,"")',
            'htmlOptions'=>array('style'=>'width: 120px'),
            ),
	

		
		array(
	 'htmlOptions'=>array('style'=>'width:100px;text-align: right'),
			'class'=>'CButtonColumn' ,'template'=>' {cargarAfip}  {ver}  {update} {delete}','buttons'=>array(
'cargarAfip' => array(
                
                'label'=>'Cargar AFIP',
                'imageUrl'=>"images/iconos/famfam/book_go.png",
                // 'click'=>'function(){alert("test");}',
                'url' => '"index.php?r=notasCredito/cargarAfip&id=".$data->id',
                 'visible'=>'!isset($data->codigo)',
                     'options' => array(
                        //'target' => '_blank', 
                        'ajax'=>array(
                                'type'=>'POST',
                                    // ajax post will use 'url' specified above 
                                'url'=>"js:$(this).attr('href')", 
                                // 'update'=>'#cobros-grid',
                                 "success"=>"$.fn.yiiGridView.update('cobros-grid');"
                            
                               ),
                 ),
            ),
'ver' => array(
                
                'label'=>'Ver Nota de credito',
                'imageUrl'=>"images/iconos/famfam/eye.png",
                'url' => '"index.php?r=notasCredito/imprimir&id=".$data->id',
                'visible'=>'isset($data->codigo)',
                     'options' => array('target' => '_blank'),
            ),
	
				)
		),
	),
)); ?>
<script>
function cargo()
{
    alert("hola");
}
</script>