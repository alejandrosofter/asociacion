<?php
$this->breadcrumbs=array(
	'Nomencladores',
);
$this->menu=array(
	array('label'=>'Nuevo Nomenclador', 'url'=>array('create')),
);

?>

<header id="page-header">
	<a style="float:right;" href="index.php?r=archivosNomencladores/create" class="btn btn-success">NUEVO ARCHIVO</a>
<h1 id="page-title"><img src="images/iconos/glyphicons/png/glyphicons-352-book-open.png"/>  NOMENCLADORES <small>archivos publico</small></h1>
 <br>
</header>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cobros-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		array(
            'type'=>'html',
            'header'=>'Fecha',
            'value'=>'"<small>".Yii::app()->dateFormatter->format("dd-MM-yyyy",$data->fechaModificacion)."</small>"',
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
            'header'=>'Solo del Profesional...',
            'value'=>'isset($data->profesional->nombreProfesionales)?$data->profesional->nombreProfesionales:"<b>DE TODOS</b>"',
            'htmlOptions'=>array('style'=>'width: 290px'),
            ),
	

		
		array(
	 'htmlOptions'=>array('style'=>'width:100px;text-align: right'),
			'class'=>'CButtonColumn' ,'template'=>' {ver}  {update} {delete}','buttons'=>array(
'ver' => array(
                
                'label'=>'Ver archivo',
                'imageUrl'=>"images/iconos/famfam/page_white_put.png",
                'url' => '"index.php?r=archivosNomencladores/descargar&id=".$data->id',
                     'options' => array('target' => '_blank'),
            ),
	
				)
		),
	),
)); ?>
