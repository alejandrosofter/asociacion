<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('class'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo',array('class'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descripcion'); ?>
		<?php echo $form->textArea($model,'descripcion',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idCategoria'); ?>
		<?php echo $form->textField($model,'idCategoria',array('class'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idSubCategoria'); ?>
		<?php echo $form->textField($model,'idSubCategoria',array('class'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'codigoObraSocial'); ?>
		<?php echo $form->textField($model,'codigoObraSocial',array('class'=>'')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->