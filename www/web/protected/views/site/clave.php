<div class="page">
<div class="box3">
<div class="themetitle2">
		<div class="themetitlewrapper">	
			<div class="titanictitle">Recuperación de Clave</div>
			<div class="titanicsubtitle">Tambien para la primera vez</div>

		</div>
</div>

<?php $form=$this->beginWidget('CActiveForm', array(
)); ?>

Por favor ingrese su email (el que ha sido cargado en la asociación):<br><br>
<?=CHtml::textField('email',isset($_POST['email'])?$_POST['email']:'',array('class'=>'text-input cforminput'));?>
<?php echo CHtml::submitButton('Aceptar',array('class'=>'submit cformbutton')); ?>
<?php $this->endWidget(); ?>
<i>Se enviará un email en el cual le dará las indicaciones para saber su contraseña.</i>

</div>
</div>