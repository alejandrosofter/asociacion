<?php
$this->breadcrumbs=array(
	'Pagos Tipos Cobroses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar PagosTiposCobros', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo PagosTiposCobros</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>