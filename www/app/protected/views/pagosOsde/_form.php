<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pagos-osde-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'prestadorEfector',array('class'=>'')); ?>
		<?php echo $form->textField($model,'prestadorEfector',array('class'=>'','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'prestadorEfector'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'afiliado',array('class'=>'')); ?>
		<?php echo $form->textField($model,'afiliado',array('class'=>'','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'afiliado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prestacion',array('class'=>'')); ?>
		<?php echo $form->textField($model,'prestacion',array('class'=>'','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'prestacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipoPrestacion',array('class'=>'')); ?>
		<?php echo $form->textField($model,'tipoPrestacion',array('class'=>'','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'tipoPrestacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cantidadPrestaciones',array('class'=>'')); ?>
		<?php echo $form->textField($model,'cantidadPrestaciones',array('class'=>'')); ?>
		<?php echo $form->error($model,'cantidadPrestaciones'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha',array('class'=>'')); ?>
		<?php echo $form->textField($model,'fecha',array('class'=>'')); ?>
		<?php echo $form->error($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'delegacionOrdenes',array('class'=>'')); ?>
		<?php echo $form->textField($model,'delegacionOrdenes',array('class'=>'','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'delegacionOrdenes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'numeroOrden',array('class'=>'')); ?>
		<?php echo $form->textField($model,'numeroOrden',array('class'=>'')); ?>
		<?php echo $form->error($model,'numeroOrden'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipoOrden',array('class'=>'')); ?>
		<?php echo $form->textField($model,'tipoOrden',array('class'=>'','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'tipoOrden'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'importeEspecialista',array('class'=>'')); ?>
		<?php echo $form->textField($model,'importeEspecialista',array('class'=>'')); ?>
		<?php echo $form->error($model,'importeEspecialista'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cantidadAyudante',array('class'=>'')); ?>
		<?php echo $form->textField($model,'cantidadAyudante',array('class'=>'')); ?>
		<?php echo $form->error($model,'cantidadAyudante'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'importeAnestecista',array('class'=>'')); ?>
		<?php echo $form->textField($model,'importeAnestecista',array('class'=>'')); ?>
		<?php echo $form->error($model,'importeAnestecista'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cantidadAnestecista',array('class'=>'')); ?>
		<?php echo $form->textField($model,'cantidadAnestecista',array('class'=>'')); ?>
		<?php echo $form->error($model,'cantidadAnestecista'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'importeGastos',array('class'=>'')); ?>
		<?php echo $form->textField($model,'importeGastos',array('class'=>'')); ?>
		<?php echo $form->error($model,'importeGastos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cantidadGastos',array('class'=>'')); ?>
		<?php echo $form->textField($model,'cantidadGastos',array('class'=>'')); ?>
		<?php echo $form->error($model,'cantidadGastos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'importeTotal',array('class'=>'')); ?>
		<?php echo $form->textField($model,'importeTotal',array('class'=>'')); ?>
		<?php echo $form->error($model,'importeTotal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'profesionPrescriptor',array('class'=>'')); ?>
		<?php echo $form->textField($model,'profesionPrescriptor',array('class'=>'')); ?>
		<?php echo $form->error($model,'profesionPrescriptor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'numeroMatriculaPrescriptor',array('class'=>'')); ?>
		<?php echo $form->textField($model,'numeroMatriculaPrescriptor',array('class'=>'')); ?>
		<?php echo $form->error($model,'numeroMatriculaPrescriptor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'letraProvinciaPrescriptor',array('class'=>'')); ?>
		<?php echo $form->textField($model,'letraProvinciaPrescriptor',array('class'=>'','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'letraProvinciaPrescriptor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'profesionEfector',array('class'=>'')); ?>
		<?php echo $form->textField($model,'profesionEfector',array('class'=>'')); ?>
		<?php echo $form->error($model,'profesionEfector'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'numeroMatriculaEfector',array('class'=>'')); ?>
		<?php echo $form->textField($model,'numeroMatriculaEfector',array('class'=>'')); ?>
		<?php echo $form->error($model,'numeroMatriculaEfector'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'letraProvinciaEfector',array('class'=>'')); ?>
		<?php echo $form->textField($model,'letraProvinciaEfector',array('class'=>'','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'letraProvinciaEfector'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'numeroTransaccion',array('class'=>'')); ?>
		<?php echo $form->textField($model,'numeroTransaccion',array('class'=>'')); ?>
		<?php echo $form->error($model,'numeroTransaccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prestadorPrescriptor',array('class'=>'')); ?>
		<?php echo $form->textField($model,'prestadorPrescriptor',array('class'=>'','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'prestadorPrescriptor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'plan',array('class'=>'')); ?>
		<?php echo $form->textField($model,'plan',array('class'=>'','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'plan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'condicionIva',array('class'=>'')); ?>
		<?php echo $form->textField($model,'condicionIva',array('class'=>'')); ?>
		<?php echo $form->error($model,'condicionIva'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'legajoInterno',array('class'=>'')); ?>
		<?php echo $form->textField($model,'legajoInterno',array('class'=>'','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'legajoInterno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'codigoOperador',array('class'=>'')); ?>
		<?php echo $form->textField($model,'codigoOperador',array('class'=>'','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'codigoOperador'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'filialTerminal',array('class'=>'')); ?>
		<?php echo $form->textField($model,'filialTerminal',array('class'=>'')); ?>
		<?php echo $form->error($model,'filialTerminal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'delegacionTerminal',array('class'=>'')); ?>
		<?php echo $form->textField($model,'delegacionTerminal',array('class'=>'')); ?>
		<?php echo $form->error($model,'delegacionTerminal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'numeroTerminal',array('class'=>'')); ?>
		<?php echo $form->textField($model,'numeroTerminal',array('class'=>'')); ?>
		<?php echo $form->error($model,'numeroTerminal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fechaTransaccion',array('class'=>'')); ?>
		<?php echo $form->textField($model,'fechaTransaccion',array('class'=>'')); ?>
		<?php echo $form->error($model,'fechaTransaccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'provinciaTerminal',array('class'=>'')); ?>
		<?php echo $form->textField($model,'provinciaTerminal',array('class'=>'')); ?>
		<?php echo $form->error($model,'provinciaTerminal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'condicionIvaEfector',array('class'=>'')); ?>
		<?php echo $form->textField($model,'condicionIvaEfector',array('class'=>'')); ?>
		<?php echo $form->error($model,'condicionIvaEfector'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombreBeneficiario',array('class'=>'')); ?>
		<?php echo $form->textField($model,'nombreBeneficiario',array('class'=>'','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nombreBeneficiario'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
