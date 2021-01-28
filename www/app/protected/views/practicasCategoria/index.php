<?php
$this->breadcrumbs=array(
	'Categorias',
);
$this->menu=array(
	array('label'=>'Nueva Categoria', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración de Categorias</h1>
</header>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'practicas-categoria-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'nombreCategoria',
		array(
			'class'=>'CButtonColumn','template'=>'{update} {delete}'
		),
	),
)); ?>
