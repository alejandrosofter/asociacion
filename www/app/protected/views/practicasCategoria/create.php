<?php
$this->breadcrumbs=array(
	'Categorias'=>array('index'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Listar Categorias', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo Categoria</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>