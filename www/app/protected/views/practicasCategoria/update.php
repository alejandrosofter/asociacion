<?php
$this->breadcrumbs=array(
	'Practicas Categorias'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar PracticasCategoria', 'url'=>array('index')),
	array('label'=>'Nuevo PracticasCategoria', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro PracticasCategoria <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>