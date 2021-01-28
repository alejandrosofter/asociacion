<?php
$this->breadcrumbs=array(
	'Tipo de Cobros',
);
$this->menu=array(
	array('label'=>'Nuevo CobrosTipos', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Tipo de Cobros</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cobros-tipos-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'nombreTipoCobro',
		array(
			'class'=>'CButtonColumn','template'=>'{update} {delete}'
		),
	),
)); ?>
