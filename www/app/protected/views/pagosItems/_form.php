<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pagos-items-form',
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
		<?php echo $form->labelEx($model,'importe',array('class'=>'')); ?>
		<?php echo $form->textField($model,'importe',array('class'=>'')); ?>
		<?php echo $form->error($model,'importe'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'detalle',array('class'=>'')); ?>
		<?php echo $form->textArea($model,'detalle',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'detalle'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idTipoItemPago',array('class'=>'')); ?>
		<?php echo $form->textField($model,'idTipoItemPago',array('class'=>'')); ?>
		<?php echo $form->error($model,'idTipoItemPago'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
