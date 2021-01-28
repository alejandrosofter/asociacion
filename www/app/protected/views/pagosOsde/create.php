<?php
$this->breadcrumbs=array(
	'Pagos Osdes'=>array('index'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Listar Pagos Osde', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo Pagos Osde</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>