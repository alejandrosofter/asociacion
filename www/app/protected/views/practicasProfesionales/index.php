<?php
$this->breadcrumbs=array(
	'Practicas Profesionales',
);
$this->menu=array(
	array('label'=>'Nueva Practica Profesional', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title"><img src="images/iconos/glyphicons/png/glyphicons-774-auction.png"/> PRACTICAS <small>realizadas por profesionales</small></h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'practicas-profesionales-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		array(
			'type'=>'html',
			'header'=>'Fecha',
			'value'=>'$data->fechaPractica',
			),
		'profesional.nombreProfesionales',
		'obraSocial.nombreOs',
		'cantidad',
		'prac.nombrePractica',
		array(
			'class'=>'CButtonColumn','template'=>'{update} {delete}'
		),
	),
)); ?>
