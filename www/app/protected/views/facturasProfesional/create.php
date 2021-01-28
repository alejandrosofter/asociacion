<?php
$this->breadcrumbs=array(
	'Facturas Profesionales'=>array('index'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Listar FacturasProfesional', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nueva Factura</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>