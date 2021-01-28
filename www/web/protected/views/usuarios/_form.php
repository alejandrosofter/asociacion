
<div class="content-form">
	 <? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/up/jquery.uploadify.min.js', CClientScript::POS_BEGIN); ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuarios-form',
	'enableAjaxValidation'=>false,
)); ?>
<div style='float:right;'>
</div>
<link rel="stylesheet" type="text/css" href="js/up/uploadify.css">
<div class="two-thirds">
	<p class="note">Los campos con <span class="required">*</span> son obligatorios</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombreUsuario',array('class'=>'')); ?>
		<?php echo $form->textField($model,'nombreUsuario',array('class'=>'text','size'=>50,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nombreUsuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'clave',array('class'=>'')); ?>
		<?php echo $form->textField($model,'clave',array('class'=>'text','size'=>50,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'clave'); ?>
	</div>

	<?php echo $form->textField($model,'fechaAlta',array('TYPE'=>'hidden','size'=>60,'maxlength'=>255)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email',array('class'=>'')); ?>
		<?php echo $form->textField($model,'email',array('class'=>'text','size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
			<div id="queue"></div>
	
	<?php echo $form->textField($model,'imagen',array('TYPE'=>'hidden')); ?>
	<script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			label='<?=$model->imagen?>'==""?'SELECCIONAR':'CAMBIAR';
			$('#file_upload').uploadify({
				'buttonText' : label,
				'buttonClass':'boton',
				'multi':false,
				'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				},
				'onUploadComplete' : function(file) {
            mostrarArchivo(file.name);
        },
				'swf'      : 'js/up/uploadify.swf',
				'uploader' : 'index.php?r=usuarios/subirImagen'
			});
		});
		function mostrarArchivo(nombre){
			$.post("index.php?r=usuarios/imagenCode64", { imagen: nombre},
   function(data) {
    $('#imagen').html('<img alt="" src="data:image/png;base64,'+data+' "/>');
    $('#Usuarios_imagen').val(data);
    $('#file_upload').uploadify({'buttonText' : 'CAMBIAR'});
   });
		}
	</script>
		<?php echo $form->error($model,'imagen'); ?>
	</div>
	<?if($model->esAdministrativo==1||$model->isNewRecord ){?>
	<div class="row">
		<?php echo $form->labelEx($model,'esAdministrativo',array('class'=>'')); ?>
		<?php echo $form->checkbox($model,'esAdministrativo',array('class'=>'text')); ?>
		<?php echo $form->error($model,'esAdministrativo'); ?>
	</div>

	<?}?>
		<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Nuevo' : 'Guardar',array('class'=>'button large')); ?>
	</div>
</div>


<?php $this->endWidget(); ?>

</div><!-- form -->