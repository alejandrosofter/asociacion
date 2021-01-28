<h1>Informe por OBRA SOCIAL</h1>
<?php $form=$this->beginWidget('CActiveForm', array('method'=>'get')); ?>
<b>Obra Social</b>
<?php $this->widget('ext.2select.ESelect2',array(
  'name'=>'idObraSocial',
  'value'=>isset($_GET['idObraSocial'])?$_GET['idObraSocial']:'',
   'htmlOptions'=>array ('style'=>'width:180px','prompt'=>'Seleccione...'),
    'options'=>array(
    	'allowClear'=>true,
    'placeholder'=>'Seleccione'),
  'data'=>CHtml::listData(ObrasSociales::model()->findAll(array('order'=>'nombreOs')), 'id', 'nombreOs'))
); ?>
<b> Desde</b>
		<?php $this->widget('ext.2select.ESelect2',array(
  'name'=>'mesInicio',
  'htmlOptions'=>array ('style'=>'width:100px'),
  'attribute'=>'mesInicio',
  'value'=>$mesInicio,
  'data'=>PracticasProfesionales::model()->meses())
); ?>
<input type='text' name='anoInicio' attribute='anoInicio' value="<?=$anoInicio?>" style='width:60px'/>
    
		<b> Hasta</b>
		<?php $this->widget('ext.2select.ESelect2',array(
  'name'=>'mesFin',
  'value'=>$mesFin,
  'htmlOptions'=>array ('style'=>'width:100px'),
  'attribute'=>'mesFin',
  'data'=>PracticasProfesionales::model()->meses())
); ?>
<input type='text' name='anoFin' attribute='anoFin' value="<?=$anoFin?>" style='width:60px'/>
		<?php echo CHtml::submitButton('Aceptar',array('class'=>'btn btn-primary')); ?>
<?php $this->endWidget(); ?>
<?=$plantillas?>