<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'facturas-profesional-rango-nomencladores-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="">
		<?php echo $form->labelEx($model,'fechaDesde',array('class'=>'')); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'attribute'=>'fechaDesde',
    'model'=>$model,
    // additional javascript options for the date picker plugin
     'options'=>array(
        'showAnim'=>'fold',
        'dateFormat' => 'yy-mm-dd', // save to db format
        'altFormat' => 'dd-mm-yy', // show to user format
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
)); ?>
		<?php echo $form->error($model,'fechaDesde'); ?>
	</div>
    <div class="">
        <?php echo $form->labelEx($model,'fechaHasta',array('class'=>'')); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'attribute'=>'fechaHasta',
    'model'=>$model,
    // additional javascript options for the date picker plugin
     'options'=>array(
        'showAnim'=>'fold',
        'dateFormat' => 'yy-mm-dd', // save to db format
        'altFormat' => 'dd-mm-yy', // show to user format
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
)); ?>
        <?php echo $form->error($model,'fechaHasta'); ?>
    </div>
        <div class="">
        <?php echo $form->labelEx($model,'idObraSocial',array('class'=>'')); ?>
        <?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:280px'),
  'attribute'=>'idObraSocial',
  'data'=>CHtml::listData(ObrasSociales::model()->findAll(array('order'=>'nombreOs')), 'id', 'nombreOs'))
); ?>
        <?php echo $form->error($model,'fechaHasta'); ?>
    </div>
   
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'ACEPTAR' : 'GUARDAR',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
