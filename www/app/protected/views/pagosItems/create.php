<?php
$this->breadcrumbs=array(
	'Pagos Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar PagosItems', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo PagosItems</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>