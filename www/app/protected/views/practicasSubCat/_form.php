<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'practicas-sub-cat-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombreSubCat',array('class'=>'')); ?>
		<?php echo $form->textField($model,'nombreSubCat',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nombreSubCat'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
