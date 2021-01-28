<div class="row">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profesionales-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
<div class="span3">
	<div class="">
		<?php echo $form->labelEx($model,'nombre',array('class'=>'')); ?>
		<?php echo $form->textField($model,'nombre',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'apellido',array('class'=>'')); ?>
		<?php echo $form->textField($model,'apellido',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'apellido'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'nroMatriculaNacional',array('class'=>'')); ?>
		<?php echo $form->textField($model,'nroMatriculaNacional',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nroMatriculaNacional'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'nroMatriculaProvincial',array('class'=>'')); ?>
		<?php echo $form->textField($model,'nroMatriculaProvincial',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nroMatriculaProvincial'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'email',array('class'=>'')); ?>
		<?php echo $form->textField($model,'email',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'telefono',array('class'=>'')); ?>
		<?php echo $form->textField($model,'telefono',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'telefono'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'domicilio',array('class'=>'')); ?>
		<?php echo $form->textField($model,'domicilio',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'domicilio'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>
</div>
<div class="span3">
	<div class="">
		<?php echo $form->labelEx($model,'idCondicionIva',array('class'=>'')); ?>
		<?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:280px','placeholder'=>'seleccione...'),
  'attribute'=>'idCondicionIva',
  'data'=>CHtml::listData(CondicionIva::model()->findAll(), 'id', 'nombreIva'))
); ?>
		<?php echo $form->error($model,'idCondicionIva'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'cuit',array('class'=>'')); ?>
		<?php echo $form->textField($model,'cuit',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'cuit'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'dni',array('class'=>'')); ?>
		<?php echo $form->textField($model,'dni',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'dni'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'regimen',array('class'=>'')); ?>
		<?php echo $form->dropDownList($model,'regimen',Profesionales::model()->getRegimenes(),array ('style'=>'width:300px;',"prompt"=>"Seleccione ...")); ?>
		<?php echo $form->error($model,'regimen'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'localidad',array('class'=>'')); ?>
		<?php echo $form->textField($model,'localidad',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'localidad'); ?>
	</div>

	
</div>
<div class="span3">
	<h3>Datos del usuario WEB</h3>
	<?=$this->renderPartial('/profesionalesUsuarios/_form2',array('model'=>$modelUsuario,'form'=>$form));?>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
