<?php
$this->breadcrumbs=array(
	'Archivos Nomencladores'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ArchivosNomencladores','url'=>array('index')),
	array('label'=>'Create ArchivosNomencladores','url'=>array('create')),
	array('label'=>'View ArchivosNomencladores','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage ArchivosNomencladores','url'=>array('admin')),
);
?>

<h1>Actualizar <b>NOMENCLADOR</b> </h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>