<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comunicados-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

		<?php echo $form->textField($model,'fecha',array('TYPE'=>'hidden')); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'mensaje',array('class'=>'')); ?>
		<?php echo $form->textArea($model,'mensaje',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'mensaje'); ?>
	</div>
	<div class="row">
		<?=$this->renderPartial('_archivos');?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'enviaMail',array('class'=>'')); ?>
		<?php echo $form->checkBox($model,'enviaMail',array('class'=>'')); ?>
		<?php echo $form->error($model,'enviaMail'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
