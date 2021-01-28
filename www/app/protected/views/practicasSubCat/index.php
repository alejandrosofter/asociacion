<?php
$this->breadcrumbs=array(
	'Sub Categorias',
);
$this->menu=array(
	array('label'=>'Nueva Sub-Categoria', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración Sub Categorias</h1>
</header>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'practicas-sub-cat-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'nombreSubCat',
		array(
			'class'=>'CButtonColumn','template'=>'{update} {delete}'
		),
	),
)); ?>
