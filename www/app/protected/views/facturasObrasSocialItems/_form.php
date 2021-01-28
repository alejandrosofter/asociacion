<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'facturas-obras-social-items-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idFacturaObraSocial',array('class'=>'')); ?>
		<?php echo $form->textField($model,'idFacturaObraSocial',array('class'=>'')); ?>
		<?php echo $form->error($model,'idFacturaObraSocial'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idFacturaProfesional',array('class'=>'')); ?>
		<?php echo $form->textField($model,'idFacturaProfesional',array('class'=>'')); ?>
		<?php echo $form->error($model,'idFacturaProfesional'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
