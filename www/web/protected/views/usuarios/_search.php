<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textField($model,'buscar',array('class'=>'')); ?>

		<?php echo CHtml::submitButton('Cambiar'); ?>


<?php $this->endWidget(); ?>

</div><!-- search-form -->