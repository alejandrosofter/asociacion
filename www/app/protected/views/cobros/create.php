<?php
$this->breadcrumbs=array(
	'Cobros'=>array('index'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Listar Cobros', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">NUEVO COBRO <small>de obra social</small></h1>
</header>
<?php echo $this->renderPartial('form2', array('idObraSocial'=>$idObraSocial,'model'=>$model,'items'=>$items,'modelObra'=>$modelObra)); ?>