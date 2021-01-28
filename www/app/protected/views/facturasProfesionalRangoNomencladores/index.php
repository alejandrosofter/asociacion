<?php
$this->breadcrumbs=array(
	'Rangos de Nomencladores',
);


?>
<?php
$this->breadcrumbs=array(
	'Rangos de  Nomencladores'=>array('index'),
	'Todos',
);?>
<div style="float:right"> 
<a class="btn btn-success" href="index.php?r=facturasProfesionalRangoNomencladores/create" type="button"><i class="icon-calendar icon-white"></i>NUEVO RANGO</a>

</div>
<h1>RANGOS NOMENCLADORES <small> para nomencladores</small></h1>
<?=$this->renderPartial('_search',array('model'=>$model));?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'facturas-profesional-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		
		array(
            'type'=>'html',
            'header'=>'O.S',
            'value'=>'"<small>".$data->nombreOs."</small>"',
            'htmlOptions'=>array('style'=>'width: 190px'),
            ),
		array(
            'type'=>'html',
            'header'=>'Fecha Desde',
            'value'=>'"<small>".Yii::app()->dateFormatter->format("dd-MM-yyyy",$data->fechaDesde)."</small>"',
            'htmlOptions'=>array('style'=>'width: 90px'),
            ),
		array(
            'type'=>'html',
            'header'=>'Fecha Hasta',
            'value'=>'"<small>".Yii::app()->dateFormatter->format("dd-MM-yyyy",$data->fechaHasta)."</small>"',
            'htmlOptions'=>array('style'=>'width: 90px'),
            ),
		array(
			'class'=>'CButtonColumn','template'=>' {recalcularFacturas} {delete} {update} ','htmlOptions'=>array('style'=>'width:40px'),
			'buttons'=>array(
	 'recalcularFacturas' => array(
                
                'label'=>'Recalcular Facturas Pendientes',
                'imageUrl'=>'images/iconos/famfam/arrow_refresh.png',
                'url' => '"index.php?r=facturasProfesionalRangoNomencladores/recalculaImporte&id=".$data->id',
                

            ))
           )
))); ?>
