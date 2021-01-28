<?php
$this->breadcrumbs=array(
	'Practicas Profesionales'=>array('index'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Listar Practicas Profesionales', 'url'=>array('index')),
);
?>
<header id="page-header"><h1>CARGA <small>DE PRACTICAS</small></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>