<?php
$this->breadcrumbs=array(
	'Prácticas'=>array('index'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Listar Prácticas', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nueva Práctica</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>