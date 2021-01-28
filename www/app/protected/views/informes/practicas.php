<h1>Informe por PRACTICAS</h1>
<?php $form=$this->beginWidget('CActiveForm', array('method'=>'get')); ?>

<b> Fecha Inicio</b>
		<?php 
$this->widget('zii.widgets.jui.CJuiDatePicker',array(
    'name'=>'fechaInicio',
    'value'=>isset($_GET['fechaInicio'])?$_GET['fechaInicio']:Date('Y-m-d'),
    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
        'dateFormat'=>'yy-mm-dd',
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;width:80px'
    ),
));
		?>
		<b> Fecha Fin</b>
		<?php 
$this->widget('zii.widgets.jui.CJuiDatePicker',array(
    'name'=>'fechaFin',
    'value'=>isset($_GET['fechaFin'])?$_GET['fechaFin']:Date('Y-m-d'),
    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
        'dateFormat'=>'yy-mm-dd',
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;width:80px'
    ),
));
		?>
		<?php echo CHtml::submitButton('Aceptar'); ?>
<?php $this->endWidget(); ?>
<?=$plantillas?>