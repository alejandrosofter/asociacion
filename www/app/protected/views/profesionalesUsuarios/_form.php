<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profesionales-usuarios-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idProfesional',array('class'=>'')); ?>
		<?php echo $form->textField($model,'idProfesional',array('class'=>'')); ?>
		<?php echo $form->error($model,'idProfesional'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idUsuario',array('class'=>'')); ?>
		<?php echo $form->textField($model,'idUsuario',array('class'=>'')); ?>
		<?php echo $form->error($model,'idUsuario'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
