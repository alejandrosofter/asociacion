<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'archivos-nomencladores-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="help-block">Campos <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
<?php echo $form->labelEx($model,'fechaModificacion',array('class'=>'')); ?>
<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'attribute'=>'fechaModificacion',
    'model'=>$model,
    // additional javascript options for the date picker plugin
     'options'=>array(
        'showAnim'=>'fold',
        'dateFormat' => 'yy-mm-dd', // save to db format
        'altFormat' => 'dd-mm-yy', // show to user format
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;',
        'class'=>'span2'
    ),
)); ?>
<div class="">
    <?php echo $form->labelEx($model,'idProfesional',array('class'=>'')); ?>
    <?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:280px','placeholder'=>'seleccione...'),
  'attribute'=>'idProfesional',
  'data'=>CHtml::listData(Profesionales::model()->findAll(array('order'=>'apellido')), 'id', 'nombreProfesionales'))
); ?>
    <?php echo $form->error($model,'idProfesional'); ?>
  </div>
<?php echo $form->labelEx($model,'idObraSocial',array('class'=>'')); ?>
    <?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:280px','onchange'=>'mostrarUltimasCargas()','placeholder'=>'seleccione...'),
  'attribute'=>'idObraSocial',
  'data'=>CHtml::listData(ObrasSociales::model()->findAll(array('order'=>'nombreOs')), 'id', 'nombreOs'))
); ?>

	
<?php echo $form->labelEx($model,'data',array('class'=>'')); ?>
	<?php echo $form->fileField($model,'data',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'ACEPTAR' : 'GUARDAR',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
