<div class="row">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'facturas-obras-social-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
<div class="span5">
	<div class="">
		<?php echo $form->labelEx($model,'fecha',array('class'=>'')); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'attribute'=>'fecha',
    'model'=>$model,
    // additional javascript options for the date picker plugin
     'options'=>array(
        'showAnim'=>'fold',
        'dateFormat' => 'yy-mm-dd', // save to db format
        'altFormat' => 'dd-mm-yy', // show to user format
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;',
        'onchange'=>'cambiaFecha()'
    ),
)); ?>
		<?php echo $form->error($model,'fecha'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'idObraSocial',array('class'=>'')); ?>
		<?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('onchange'=>'cambiaObraSocial()','style'=>'width:280px','placeholder'=>'seleccione...'),
  'attribute'=>'idObraSocial',
  'data'=>CHtml::listData(ObrasSociales::model()->findAll(array('order'=>'nombreOs')), 'id', 'nombreOs'))
); ?>
		<?php echo $form->error($model,'idObraSocial'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'importe',array('class'=>'')); ?>
		<?php echo $form->textField($model,'importe',array('class'=>'')); ?>
		<?php echo $form->error($model,'importe'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'estado',array('class'=>'')); ?>
		<?php echo $form->dropDownList($model,'estado',FacturasObrasSocial::model()->getEstados(),array ('style'=>'width:300px;',"prompt"=>"Seleccione ...")); ?>
		<?php echo $form->error($model,'estado'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'detalle',array('class'=>'')); ?>
		<?php echo $form->textArea($model,'detalle',array('rows'=>4, 'style'=>'width:100%')); ?>
		<?php echo $form->error($model,'detalle'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'idCobroTipo',array('class'=>'')); ?>
		<?php echo $form->dropDownList($model,'idCobroTipo',CHtml::listData(CobrosTipos::model()->findAll(), 'id', 'nombreTipoCobro'),array ('style'=>'width:150px;',"prompt"=>"Seleccione ...")); ?>
		<p class="text-warning">Seleccione a que tipo de elemento imputar. En caso de no seleccionar irá a tipo <strong>COBRO</strong></p>
		<?php echo $form->error($model,'idCobroTipo'); ?>
	</div>

	<div class="">
	Nueva Carga <?php echo CHtml::checkBox('nuevaCarga',isset($_POST['nuevaCarga']))?>
	Es Refacturacion? <?php echo CHtml::checkBox('refacturacion',isset($_POST['refacturacion']))?>
	</div>
	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>
</div>
	<div class="span6">
	<h3>Items</h3>
	<div id='items'>
	<i>No hay Items</i>
	</div>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
cambiaFecha();
cambiaObraSocial();
$("#refacturacion").click(function(){
	cambiaObraSocial();
})
function cambiaFecha()
{
	var fecha=$('#FacturasObrasSocial_fecha').val();
	var meses=new Array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
	
	fecha=fecha.split('-');
	
	var index=fecha[1]-2;
	
	if(index<0){
		index=11;
		fecha[0]--;
	}
	var mes=meses[index];
	var ano=fecha[0];
	$('#FacturasObrasSocial_detalle').val('En concepto de servicios prestados por el mes de '+mes+' del '+ano+'.');
}
function cambiaObraSocial()
{
	var refacturado=($('#refacturacion').prop('checked'))?true:null;
	$.getJSON('index.php?r=facturasProfesional/getItems',{idObraSocial:$('#FacturasObrasSocial_idObraSocial').val(),refacturado:refacturado }, function(data) {
 	$('#items').html(data.vista);
 	$('#FacturasObrasSocial_importe').val(data.importe);

});
}
</script>