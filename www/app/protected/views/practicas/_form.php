<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'practicas-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'codigo',array('class'=>'')); ?>
		<?php echo $form->textField($model,'codigo',array('class'=>'')); ?>
		<?php echo $form->error($model,'codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion',array('class'=>'')); ?>
		<?php echo $form->textArea($model,'descripcion',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idCategoria',array('class'=>'')); ?>
		<?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:200px'),
  'attribute'=>'idCategoria',
  'data'=>CHtml::listData(PracticasCategoria::model()->findAll(), 'id', 'nombreCategoria'))
); ?>
		<?php echo $form->error($model,'idCategoria'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idSubCategoria',array('class'=>'')); ?>
		<?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:200px'),
  'attribute'=>'idSubCategoria',
  'data'=>CHtml::listData(PracticasSubCat::model()->findAll(), 'id', 'nombreSubCat'))
); ?>
		<?php echo $form->error($model,'idSubCategoria'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'codigoObraSocial',array('class'=>'')); ?>
		<?php echo $form->textField($model,'codigoObraSocial',array('class'=>'')); ?>
		<?php echo $form->error($model,'codigoObraSocial'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
