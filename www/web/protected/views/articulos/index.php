<?php
$this->breadcrumbs=array(
	'Articuloses',
);
$this->menu=array(
	array('label'=>'Nuevo Articulos', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración Articuloses</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'articulos-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'id',
		'titulo',
		'contenido',
		'fechaUpdate',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
