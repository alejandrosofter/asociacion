<?php
$this->breadcrumbs=array(
	'Facturas Obras Social Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar FacturasObrasSocialItems', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo FacturasObrasSocialItems</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>