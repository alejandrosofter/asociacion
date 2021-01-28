<?php
$this->breadcrumbs=array(
	'Articulos',
);
$this->menu=array(
	array('label'=>'Nuevo Articulos', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración de Articulos</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'articulos-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'titulo',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
