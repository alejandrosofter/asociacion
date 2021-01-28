<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'impuestos-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombreImpuesto',array('class'=>'')); ?>
		<?php echo $form->textField($model,'nombreImpuesto',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nombreImpuesto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'porcentaje',array('class'=>'')); ?>
		<?php echo $form->textField($model,'porcentaje',array('class'=>'')); ?>
		<?php echo $form->error($model,'porcentaje'); ?>
	</div>
<div class="row">
		<?php echo $form->labelEx($model,'esRetencion',array('class'=>'')); ?>
		<?php echo $form->checkBox($model,'esRetencion',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'esRetencion'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'descripcion',array('class'=>'')); ?>
		<?php echo $form->textArea($model,'descripcion',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
