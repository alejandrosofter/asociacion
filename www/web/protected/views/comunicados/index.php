<?php
$this->breadcrumbs=array(
	'Comunicadoses',
);
$this->menu=array(
	array('label'=>'Nuevo Comunicado', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Comunicados</h1>
</header>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'comunicados-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'fecha',
		'mensaje',
		array('header'=>'Envia Mail?','value'=>'$data->enviaMail==1?"si":"no"'),
		array(
			'class'=>'CButtonColumn','template'=>'{delete}'
		),
	),
)); ?>
