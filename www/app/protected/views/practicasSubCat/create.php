<?php
$this->breadcrumbs=array(
		'Sub Categorias'=>array('index'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Listar Sub-Categorias', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nueva Sub-Categoria</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>