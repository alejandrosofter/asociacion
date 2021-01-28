<div class="">


	<?php echo $form->errorSummary($model); ?>

	<div class="">
		<?php echo $form->labelEx($model,'nombreUsuario',array('class'=>'')); ?>
		<?php echo $form->textField($model,'nombreUsuario',array('class'=>'text','size'=>50,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nombreUsuario'); ?>
	</div>

	<div >
		<?php echo $form->labelEx($model,'clave',array('class'=>'')); ?>
		<?php echo $form->textField($model,'clave',array('class'=>'text','size'=>50,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'clave'); ?>
	</div>


</div><!-- form -->