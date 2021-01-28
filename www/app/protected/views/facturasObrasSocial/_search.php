
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get','htmlOptions'=>array('class'=>'form-search')
)); ?>

		<?php echo $form->label($model,'buscar'); ?>
		<?php echo $form->textField($model,'buscar',array('class'=>'span3','size'=>80,'maxlength'=>255)); ?>
		Estado <?php echo $form->dropDownList($model,'estado',array(''=>'TODOS','PENDIENTE'=>'PENDIENTE','CANCELADO'=>'CANCELADO'),array("style"=>"width:120px")); ?>
		<?php echo CHtml::submitButton('Buscar',array('class'=>'btn btn-primary')); ?>

<?php $this->endWidget(); ?>
