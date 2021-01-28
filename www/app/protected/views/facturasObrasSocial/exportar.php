<h1>Exportar Facturas</h1>
A continuación ud. puede exportar las facturas a formato PDF para almacenar o bien para realizar una impresión en serie:<br>
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
)); ?><br>

 <label for="resumen">Resumen <?=CHtml::checkBox('resumen',1);?> </label>
 <div class="form-inline">
     <label  for="factura">Facturas  <?=CHtml::checkBox('factura');?> </label>
   
</div>
  <br>
 <input class="btn btn-primary" type="submit" style="width: 800px" name="yt0" value="Exportar">

<?php $this->endWidget(); ?>