<?php
$this->breadcrumbs=array(
	'Pagos'=>array('index'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Listar Pagos', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo Pago</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>