<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cobros-obras-sociales-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idObraSocial',array('class'=>'')); ?>
		<?php echo $form->textField($model,'idObraSocial',array('class'=>'')); ?>
		<?php echo $form->error($model,'idObraSocial'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idFactura',array('class'=>'')); ?>
		<?php echo $form->textField($model,'idFactura',array('class'=>'')); ?>
		<?php echo $form->error($model,'idFactura'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idCobro',array('class'=>'')); ?>
		<?php echo $form->textField($model,'idCobro',array('class'=>'')); ?>
		<?php echo $form->error($model,'idCobro'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
