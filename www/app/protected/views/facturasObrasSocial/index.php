<?php
$this->breadcrumbs=array(
	'Facturas Obras Sociales',
);
$this->menu=array(
	array('label'=>'Nueva Factura', 'url'=>array('create')),
);
?>


<header id="page-header">
<h1 id="page-title"><img src="images/iconos/glyphicons/png/glyphicons-734-nearby-square.png"/>  FACTURACION A OBRAS SOCIALES <small>imprime, observa, elimina...</small></h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'facturas-obras-social-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		array(
            'type'=>'html',
            'header'=>'Fecha',
            'value'=>'"<small>".Yii::app()->dateFormatter->format("dd-MM-yyyy",$data->fecha)."</small>"',
            'htmlOptions'=>array('style'=>'width: 90px'),
            ),
		'obraSocial.nombreOs',
		
		'detalle',
		array(
            'type'=>'html',
            'header'=>'Importe',
            'value'=>'"<strong>$ ".Yii::app()->numberFormatter->formatCurrency($data->importe,"")."</strong>"',
            'htmlOptions'=>array('style'=>'width: 90px;text-align: right'),
            ),
		array(
            'type'=>'html',
            'header'=>'FE',
            'value'=>'(($data->tieneElectronica()?"<a href=\'index.php?r=facturaElectronica/DatosComprobante&id=".$data->id."\'>SI</a>":"NO")."")',
            'htmlOptions'=>array('style'=>'width: 70px;text-align: center'),
            ),
        array(
            'type'=>'html',
            'header'=>'ESTADO',
            'value'=>'"<strong fds=\'fds\' style=\'color:".$data->getColor()."\'>".$data->estado."</strong>"',
            'htmlOptions'=>array('style'=>'width: 80px;text-align: right'),
            ),
		array(
			'class'=>'CButtonColumn','template'=>' {exportar}  {resumen}  {factura} {items} {cambiaEstado} {delete} {recalculaImporte} ','htmlOptions'=>array('style'=>'width:150px'),
			'buttons'=>array(
                 'exportar' => array(
                
                'label'=>'Exportar archivo',
                'imageUrl'=>'images/iconos/famfam/table.png',
                'url' => '"index.php?r=facturasObrasSocial/exportarTxt&id=".$data->id'

            ),
                 'notaCredito' => array(
                
                'label'=>'Crear Nota de Credito',
                'imageUrl'=>'images/iconos/famfam/basket_delete.png',
                'url' => '"index.php?r=notasCredito/create&id=".$data->id'

            ),
	 'recalculaImporte' => array(
                
                'label'=>'Recalcular Importe',
                'imageUrl'=>'images/iconos/famfam/arrow_refresh.png',
                'url' => '"index.php?r=facturasObrasSocial/recalculaImporte&id=".$data->id'

            ),
                'cambiaEstado' => array(
                
                'label'=>'Cambia el estado!',
                'imageUrl'=>'images/iconos/famfam/wand.png',
                'url' => '"javascript:cambiarEstadoFactura(".$data->id.")"',

            ),
				'resumen' => array(
                
                'label'=>'Resumen',
                'imageUrl'=>'images/iconos/famfam/report.png',
                'url' => '"index.php?r=facturasObrasSocial/imprimirResumen&idFactura=".$data->id',
                'options'=>array('class'=>'imprime','data-fancybox-type'=>'iframe'),

            ),
				'factura' => array(
                
                'label'=>'Factura',
                'imageUrl'=>'images/iconos/famfam/page_green.png',
                'url' => '"index.php?r=facturasObrasSocial/imprimir&idFactura=".$data->id',
                'options'=>array('class'=>'imprime','data-fancybox-type'=>'iframe'),

            ),
				'items' => array(
                
                'label'=>'Items de la Factura',
                'imageUrl'=>'images/iconos/famfam/bullet_arrow_down.png',
                'url' => '"index.php?r=facturasObrasSocialItems/index&idFactura=".$data->id',

            ),
				)
		),
	),
)); ?>
<script>
function cambiarEstadoFactura(id)
	{
		 swal({  title: "Estas seguro de eliminar cambiar el estado?",   text: "Se cambiara el estado al opuesto...",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Si, cambialo!!"}).then(
		 function(){  
		 $.getJSON('index.php?r=facturasObrasSocial/cambiarEstado',{id:id}, function(data) {
				
			 swal("Genial!", "se ha cambiado el estado", "success");
			 location.reload();
		});
		 }
		 );
	}
</script>
