<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tabla-retenciones-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'masDe',array('class'=>'')); ?>
		<?php echo $form->textField($model,'masDe',array('class'=>'')); ?>
		<?php echo $form->error($model,'masDe'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'a',array('class'=>'')); ?>
		<?php echo $form->textField($model,'a',array('class'=>'')); ?>
		<?php echo $form->error($model,'a'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'agregadoEfectivo',array('class'=>'')); ?>
		<?php echo $form->textField($model,'agregadoEfectivo',array('class'=>'')); ?>
		<?php echo $form->error($model,'agregadoEfectivo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'agregadoPorcentaje',array('class'=>'')); ?>
		<?php echo $form->textField($model,'agregadoPorcentaje',array('class'=>'')); ?>
		<?php echo $form->error($model,'agregadoPorcentaje'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'exedenteEfectivo',array('class'=>'')); ?>
		<?php echo $form->textField($model,'exedenteEfectivo',array('class'=>'')); ?>
		<?php echo $form->error($model,'exedenteEfectivo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
