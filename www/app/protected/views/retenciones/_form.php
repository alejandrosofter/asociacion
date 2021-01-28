<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'retenciones-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idPago',array('class'=>'')); ?>
		<?php echo $form->textField($model,'idPago',array('class'=>'')); ?>
		<?php echo $form->error($model,'idPago'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'importeRetencion',array('class'=>'')); ?>
		<?php echo $form->textField($model,'importeRetencion',array('class'=>'')); ?>
		<?php echo $form->error($model,'importeRetencion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'importeBase',array('class'=>'')); ?>
		<?php echo $form->textField($model,'importeBase',array('class'=>'')); ?>
		<?php echo $form->error($model,'importeBase'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idTablaRetencion',array('class'=>'')); ?>
		<?php echo $form->textField($model,'idTablaRetencion',array('class'=>'')); ?>
		<?php echo $form->error($model,'idTablaRetencion'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
