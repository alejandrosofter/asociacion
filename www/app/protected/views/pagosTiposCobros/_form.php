<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pagos-tipos-cobros-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idTipoPago',array('class'=>'')); ?>
		<?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:280px','placeholder'=>'seleccione...'),
  'attribute'=>'idTipoPago',
  'data'=>CHtml::listData(PagosTipos::model()->findAll(), 'id', 'nombreTipoPago'))
); ?>
		<?php echo $form->error($model,'idTipoPago'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idTipoCobro',array('class'=>'')); ?>
		<?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:280px','placeholder'=>'seleccione...'),
  'attribute'=>'idTipoCobro',
  'data'=>CHtml::listData(CobrosTipos::model()->findAll(), 'id', 'nombreTipoCobro'))
); ?>
		<?php echo $form->error($model,'idTipoCobro'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
