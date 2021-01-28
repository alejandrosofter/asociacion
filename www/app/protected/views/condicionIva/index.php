<?php
$this->breadcrumbs=array(
	'Condicion Ivas',
);
$this->menu=array(
	array('label'=>'Nuevo CondicionIva', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración Condicion Ivas</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'condicion-iva-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'id',
		'nombreIva',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
