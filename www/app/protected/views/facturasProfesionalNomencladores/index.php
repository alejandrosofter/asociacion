<?php
$this->breadcrumbs=array(
	'Nomencladores',
);


?>
<?php
$this->breadcrumbs=array(
	'Nomencadores'=>array('index'),
	'Todos',
);?>
<div style="float:right"> 
<a class="btn btn-success" href="index.php?r=facturasProfesionalRangoNomencladores/index" type="button"><i class="icon-calendar icon-white"></i>RANGOS FECHA</a>
<a class="btn btn-success" href="index.php?r=facturasProfesionalNomencladores/create" type="button"><i class="icon-plus icon-white"></i>NUEVO NOMENCLADOR</a>
<a class="btn btn-success" href="index.php?r=facturasProfesionalNomencladores/importar" type="button"><i class="icon-refresh icon-white"></i>IMPORTAR</a>
</div>
<h1>NOMENCLADORES <small> para facturacion</small></h1>
<?=$this->renderPartial('_search',array('model'=>$model));?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'facturas-profesional-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		
		array(
            'type'=>'html',
            'header'=>'O.S',
            'value'=>'"<small>".$data->os->nombreOs."</small>"',
            'htmlOptions'=>array('style'=>'width: 190px'),
            ),
		'detalle',
		'codigoInterno',
		
		array(
            'type'=>'html',
            'header'=>'Cod. Externo',
            'value'=>'"<small>".(empty($data->codigoExterno)?$data->codigoExterno:"-")."</small>"',
            'htmlOptions'=>array('style'=>'width: 90px'),
            ),
		
		'importe',
		array(
			'class'=>'CButtonColumn','template'=>'{update} {delete}'
		),
	),
)); ?>
