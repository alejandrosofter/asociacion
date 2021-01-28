<?php
$this->breadcrumbs=array(
	'Cobros Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar CobrosItems', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo CobrosItems</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>