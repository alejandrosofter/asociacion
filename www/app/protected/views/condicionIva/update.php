<?php
$this->breadcrumbs=array(
	'Condicion Ivas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar CondicionIva', 'url'=>array('index')),
	array('label'=>'Nuevo CondicionIva', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro CondicionIva <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>