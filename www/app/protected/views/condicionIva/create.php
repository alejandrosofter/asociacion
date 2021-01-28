<?php
$this->breadcrumbs=array(
	'Condicion Ivas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar CondicionIva', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo CondicionIva</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>