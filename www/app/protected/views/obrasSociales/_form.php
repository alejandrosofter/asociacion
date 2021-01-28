<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'obras-sociales-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
<div class="span4"> 
	 
	<div class=""> 
		<?php echo $form->labelEx($model,'nombreOs',array('class'=>'')); ?>
		<?php echo $form->textField($model,'nombreOs',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nombreOs'); ?>
	</div>
	<div class=""> 
		<?php echo $form->labelEx($model,'estado',array('class'=>'')); ?>
		<?php echo $form->dropDownList($model,'estado',array('ACTIVA'=>'ACTIVA','INACTIVA'=>'INACTIVA'),array("style"=>"width:120px")); ?>
		<?php echo $form->error($model,'estado'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'nombreCorto',array('class'=>'')); ?>
		<?php echo $form->textField($model,'nombreCorto',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nombreCorto'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'email',array('class'=>'')); ?>
		<?php echo $form->textField($model,'email',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'telefono',array('class'=>'')); ?>
		<?php echo $form->textField($model,'telefono',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'telefono'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'direccion',array('class'=>'')); ?>
		<?php echo $form->textField($model,'direccion',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'direccion'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'preCodigo',array('class'=>'')); ?>
		<?php echo $form->textField($model,'preCodigo',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'preCodigo'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'retiene',array('class'=>'')); ?>
		<?php echo $form->checkBox($model,'retiene',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'retiene'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'realizaFacturacion',array('class'=>'')); ?>
		<?php echo $form->checkBox($model,'realizaFacturacion',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'realizaFacturacion'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'realizaFacturaCredito',array('class'=>'')); ?>
		<?php echo $form->checkBox($model,'realizaFacturaCredito',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'realizaFacturaCredito'); ?>
	</div>
	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>
</div>
	<div class="span4">
	
	<div class="">
		<?php echo $form->labelEx($model,'idOsFacturacion',array('class'=>'')); ?>
		<?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:280px','placeholder'=>'seleccione...','autoClear'=>true,),
  'attribute'=>'idOsFacturacion',
  'options'=>array(
    'allowClear'=>true,
  ),
  'data'=>CHtml::listData(ObrasSociales::model()->findAll(), 'id', 'nombreOs'))
); ?>
		<?php echo $form->error($model,'idOsFacturacion'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'cuit',array('class'=>'')); ?>
		<?php echo $form->textField($model,'cuit',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'cuit'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'idCondicionIva',array('class'=>'')); ?>
		<?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:280px','placeholder'=>'seleccione...'),
  'attribute'=>'idCondicionIva',
  'data'=>CHtml::listData(CondicionIva::model()->findAll(), 'id', 'nombreIva'))
); ?>
		<?php echo $form->error($model,'idCondicionIva'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'condicionVenta',array('class'=>'')); ?>
		<?php echo $form->dropDownList($model,'condicionVenta',ObrasSociales::model()->getCondicionesVenta(),array ('style'=>'width:300px;',"prompt"=>"Seleccione ...")); ?>
		<?php echo $form->error($model,'condicionVenta'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'contacto',array('class'=>'')); ?>
		<?php echo $form->textField($model,'contacto',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'contacto'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'localidad',array('class'=>'')); ?>
		<?php echo $form->textField($model,'localidad',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'localidad'); ?>
	</div>
	</div>
	

<?php $this->endWidget(); ?>

</div><!-- form -->
