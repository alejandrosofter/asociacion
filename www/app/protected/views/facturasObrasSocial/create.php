<?php
$this->breadcrumbs=array(
	'Facturas Obras Sociales'=>array('index'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Listar FacturasObrasSocial', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nueva Factura</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>