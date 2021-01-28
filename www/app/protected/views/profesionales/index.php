<?php
$this->breadcrumbs=array(
	'Profesionales',
);
$this->menu=array(
	array('label'=>'Nuevo Profesionales', 'url'=>array('create')),
);
?>

<header id="page-header">
<a href="index.php?r=profesionales/create" type="button" style="float:right" class="btn btn-large btn-success">AGREGAR</a>
<h1 id="page-title"><img src="images/iconos/glyphicons/png/glyphicons-500-family.png"/> PROFESIONALES <small>agrega, quita o modifica!</small>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'profesionales-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'apellido',
		'nombre',
		
		'email',
		'telefono',
		'cuit',
		'condicionIva.nombreIva',
		array('header'=>'Regimen','value'=>'$data->regimen=="actual"?"COD-116":"COD-94"'),
		array(
			'class'=>'CButtonColumn','template'=>"{update} {delete}"
		),
	),
)); ?>
