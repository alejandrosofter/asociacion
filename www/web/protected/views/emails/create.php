<?php
$this->breadcrumbs=array(
	'Emails'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Emails', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo Emails</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>