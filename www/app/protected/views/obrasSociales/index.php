<?php
$this->breadcrumbs=array(
	'Obras Sociales',
);
$this->menu=array(
	array('label'=>'Nueva Obra Social', 'url'=>array('create')),
);
?>

<header id="page-header">
	<a href="index.php?r=obrasSociales/create" type="button" style="float:right" class="btn btn-large btn-success">AGREGAR</a>
<h1 id="page-title"><img src="images/iconos/glyphicons/png/glyphicons-634-luggage-group.png"/> OBRAS SOCIALES <small>agrega, quita o modifica!</small></h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'obras-sociales-grid',
	 'rowCssClassExpression' => '$data["estado"]=="INACTIVA" ? "inactiva" : ""',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		
		'nombreOs',
		'email',
		'contacto',
		'cuit',
		array('header'=>'Os a Cargo','value'=>'isset($data->obraSocialCargo)?$data->obraSocialCargo->nombreOs:"-"'),
		'estado',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
