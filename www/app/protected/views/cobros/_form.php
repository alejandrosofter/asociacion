<div class="row">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cobros-form',
	'enableAjaxValidation'=>false,
	'focus'=>array($model,'detalle')
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
<div class='span3'>
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
        'class'=>'span2'
    ),
)); ?>
		<?php echo $form->error($model,'fecha'); ?>
	</div>
	<div class="">
		<?=$this->renderPartial('/cobrosObrasSociales/_form2',array('model'=>$modelObra,'form'=>$form));?>
	
	</div>
<div class="">
		<?php echo $form->labelEx($model,'importeDebitos',array('class'=>'')); ?>
		<?php echo $form->textField($model,'importeDebitos',array('style'=>'')); ?>
		<?php echo $form->error($model,'importeDebitos'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'importe',array('class'=>'')); ?>
		<?php echo $form->textField($model,'importe',array('style'=>'')); ?>
		<?php echo $form->error($model,'importe'); ?>
	</div>
	

</div>
<div class='span8'>
<h4>Items</h4>
<?=$this->renderPartial('_agregarItem');?>
<table class="table table-condensed">
<tr><th>Profesional</th><th>Tipo</th><th style="text-align:left">Importe</th></tr>
<tbody id='items'></tbody>
</table>
	<h2 class='pull-right' id='importeTotal'></h2>
<div class="form-actions">
		<a id='btnAceptar' class="btn btn-success" style="width:100%" onclick='ingresar()' type="button"><img src="images/iconos/famfam/1.png"/> ACEPTAR</a>
	</div>	
	
	</div>

</div>
		
</div><!-- form -->



<?php $this->endWidget(); ?>
<script>
	itemsFacturaSeleccion=[];
	function valido()
	{
		console.log(itemsFacturaSeleccion);
		console.log(items);
		if(itemsFacturaSeleccion.length==0)return false;
		return true;
	}
function ingresar()
{
	 $.blockUI({ message: '<h1><img src="images/loader.gif" /> Espere un momento por favor...</h1>' }); 

	  $.post('index.php?r=facturasObrasSocial/agregar',{cargarOtro:true,items:items,importe:$('#Cobros_importe').val(),fecha:$('#Cobros_fecha').val(),idFactura:$('#CobrosObrasSociales_idFactura').val(),idObraSocial:$('#CobrosObrasSociales_idObraSocial').val()}, function(data) {
		console.log(data);
			if(data.valido)
			window.location.replace('index.php?r=cobros/create');
			else {
				$.unblockUI();
				alert(data.error);
				
			}
},"json");
 
	

	
}

</script>
