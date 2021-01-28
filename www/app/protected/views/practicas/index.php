<?php
$this->breadcrumbs=array(
	'Practicas',
);
$this->menu=array(
	array('label'=>'Nueva Práctica', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración de Prácticas</h1>
</header>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'practicas-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'codigo',
		'descripcion',
		'categoria.nombreCategoria',
		'subCategoria.nombreSubCat',
		'codigoObraSocial',
		array(
			'class'=>'CButtonColumn','template'=>'{update} {delete}'
		),
	),
)); ?>
