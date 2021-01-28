<?php
$this->breadcrumbs=array(
	'Pagos Tiposes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar PagosTipos', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo PagosTipos</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>