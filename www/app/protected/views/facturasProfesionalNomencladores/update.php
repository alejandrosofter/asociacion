<?php
$this->breadcrumbs=array(
	'Facturas Profesional Nomencladores'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FacturasProfesionalNomencladores','url'=>array('index')),
	array('label'=>'Create FacturasProfesionalNomencladores','url'=>array('create')),
	array('label'=>'View FacturasProfesionalNomencladores','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage FacturasProfesionalNomencladores','url'=>array('admin')),
);
?>

<h1>Update FacturasProfesionalNomencladores <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>