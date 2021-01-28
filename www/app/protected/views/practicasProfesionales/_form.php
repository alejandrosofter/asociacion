<div class="span4">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'practicas-profesionales-form',
	'enableAjaxValidation'=>false,
	"focus"=>array($model,"cantidad")
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'mes',array('class'=>'')); ?>
		<?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:120px'),
  'attribute'=>'mes',
  'data'=>PracticasProfesionales::model()->meses())
); ?>
		<?php echo $form->textField($model,'ano',array('class'=>'span1')); ?>
		<?php echo $form->error($model,'mes'); ?>
		<?php echo $form->error($model,'ano'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idProfesional',array('class'=>'')); ?>
		<?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:280px'),
  'attribute'=>'idProfesional',
  'data'=>CHtml::listData(Profesionales::model()->findAll(array('order'=>'apellido')), 'id', 'nombreProfesionales'))
); ?>
		<?php echo $form->error($model,'idProfesional'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idObraSocial',array('class'=>'')); ?>
		<?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:200px'),
  'attribute'=>'idObraSocial',
  'data'=>CHtml::listData(ObrasSociales::model()->findAll(array('order'=>'nombreOs')), 'id', 'nombreOs'))
); ?>
		<?php echo $form->error($model,'idObraSocial'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cantidad',array('class'=>'')); ?>
		<?php echo $form->textField($model,'cantidad',array('class'=>'')); ?>
		<?php echo $form->error($model,'cantidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idPractica',array('class'=>'')); ?>
		<?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:200px'),
  'attribute'=>'idPractica',
  'data'=>CHtml::listData(Practicas::model()->findAll(), 'id', 'nombrePractica'))
); ?>
		<?php echo $form->error($model,'idPractica'); ?>
	</div>
Nueva Carga <?=CHtml::checkBox('cargarOtro',isset($_GET['cargarOtro'])?$_GET['cargarOtro']:false); ?>
	<br>	<br>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array("class"=>"btn btn-success","style"=>"width:100%")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<div class="span6">
<h2>Utimas Cargas</h2>
<div id='ultimas'>No hay registros...</div>
</div>
<script> 

$("#FacturasProfesional_importe").focus(); 
mostrarUltimasCargas();
function mostrarUltimasCargas()
{
	buscarUltimas();
}
function buscarUltimas()
{
	$.get( "index.php?r=practicasProfesionales/ultimas",{}, function( data ) {
 	$('#ultimas').html(data);
//	$("#PracticasProfesionales_idProfesional").select2('open');
	});
}

</script>