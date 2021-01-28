<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'condicion-iva-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombreIva',array('class'=>'')); ?>
		<?php echo $form->textField($model,'nombreIva',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nombreIva'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
