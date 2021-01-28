<?php
$this->breadcrumbs=array(
	'Comunicadoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Comunicados', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo Comunicado</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>