<?php
$this->breadcrumbs=array(
	'Tipos'=>array('index'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Listar ImpuestosTipos', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo Tipo</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>