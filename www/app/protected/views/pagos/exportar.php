<h1>Exportar Pagos</h1>
A continuación ud. puede exportar los pagos a formato PDF para almacenar o bien para realizar una impresión en serie:<br>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'articulos-form',
	'enableAjaxValidation'=>false,
)); ?>
<strong>Desde </strong><?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(

    'name'=>'fechaDesde',
    'value'=>$fechaDesde,
    // additional javascript options for the date picker plugin
     'options'=>array(
        'showAnim'=>'fold',
        'dateFormat' => 'yy-mm-dd', // save to db format
        'altFormat' => 'dd-mm-yy', // show to user format
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;width:80px',
    ),
)); ?>

<strong>Hasta </strong><?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(

    'name'=>'fechaHasta',
    'value'=>$fechaHasta,
    // additional javascript options for the date picker plugin
     'options'=>array(
        'showAnim'=>'fold',
        'dateFormat' => 'yy-mm-dd', // save to db format
        'altFormat' => 'dd-mm-yy', // show to user format
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;width:80px',
    ),
)); ?>
 Comprobante <?=CHtml::checkBox('comprobante',1);?>
 Retención <?=CHtml::checkBox('retencion');?>

<input class="btn btn-primary" type="submit" name="yt0" value="Exportar">

<?php $this->endWidget(); ?>