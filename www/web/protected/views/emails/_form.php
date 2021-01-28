<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'emails-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'mensaje',array('class'=>'')); ?>
		<?php echo $form->textArea($model,'mensaje',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'mensaje'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remitente',array('class'=>'')); ?>
		<?php echo $form->textArea($model,'remitente',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'remitente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha',array('class'=>'')); ?>
		<?php echo $form->textField($model,'fecha',array('class'=>'')); ?>
		<?php echo $form->error($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'estado',array('class'=>'')); ?>
		<?php echo $form->textField($model,'estado',array('class'=>'','size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'estado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
