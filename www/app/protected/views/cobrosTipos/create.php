<?php
$this->breadcrumbs=array(
	'Cobros Tiposes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar CobrosTipos', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo CobrosTipos</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>