<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post','htmlOptions'=>array('class'=>'form-search')
)); ?>

		<?php echo CHtml::label('Profesional','idProfesional'); ?>
		<?php $this->widget('ext.2select.ESelect2',array(
  'name'=>'idProfesional',
  'value'=>isset($_POST['idProfesional'])?$_POST['idProfesional']:'',
  'htmlOptions'=>array ('style'=>'width:280px'),
  'data'=>CHtml::listData(Profesionales::model()->findAll(array('order'=>'apellido')), 'id', 'nombreProfesionales'))
); ?>
<input name='ano' type='text' class='span1' value='<?=isset($_POST["ano"])?$_POST["ano"]:Date("Y")?>'></input>
<button type='submit' class='btn btn-primary'> <i class="icon-search icon-white"></i> </button>

<?php $this->endWidget(); ?>