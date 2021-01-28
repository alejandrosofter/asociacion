<?php
$this->breadcrumbs=array(
	'Emails',
);
$this->menu=array(
	array('label'=>'Nuevo Emails', 'url'=>array('create')),
);
?>
<h1>Emails </h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'emails-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'fecha',
		'remitente',
		
		'estado'
	),
)); ?>
