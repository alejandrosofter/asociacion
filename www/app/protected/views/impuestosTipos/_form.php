<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'impuestos-tipos-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

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

	<div class="row">
		<?php echo $form->labelEx($model,'idImpuesto',array('class'=>'')); ?>
		<?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:280px','placeholder'=>'seleccione...'),
  'attribute'=>'idImpuesto',
  'data'=>CHtml::listData(Impuestos::model()->findAll(), 'id', 'nombreImpuesto'))
); ?>
		<?php echo $form->error($model,'idImpuesto'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
