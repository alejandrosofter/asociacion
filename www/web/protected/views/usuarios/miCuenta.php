<header id="page-header">
<h1 id="page-title">Mis Datos</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

echo Yii::app()->cliente->getUltimosPagos(15,2013);