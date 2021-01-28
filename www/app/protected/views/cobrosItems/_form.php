<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cobros-items-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
<div class="row">
<?php echo $form->labelEx($model,'idProfesional',array('class'=>'')); ?>
<?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:200px'),
  'attribute'=>'idProfesional',
  'data'=>CHtml::listData(Profesionales::model()->findAll(), 'id', 'nombreProfesionales'))
); ?>
<?php echo $form->error($model,'idProfesional'); ?>
</div>
	<div class="row">
		<?php echo $form->labelEx($model,'detalle',array('class'=>'')); ?>
		<?php echo $form->textArea($model,'detalle',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'detalle'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idTipoItem',array('class'=>'')); ?>
		<?php echo $form->dropDownList($model,'idTipoItem',CHtml::listData(CobrosTipos::model()->buscarTipos(), 'id', 'nombreTipoCobro'),array ('style'=>'width:110px;',"prompt"=>"Seleccione ...")); ?>
		<?php echo $form->error($model,'idTipoItem'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'importe',array('class'=>'')); ?>
		<?php echo $form->textField($model,'importe',array('class'=>'')); ?>
		<?php echo $form->error($model,'importe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
