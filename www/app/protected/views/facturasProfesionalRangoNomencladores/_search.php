<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	 'htmlOptions'=>array(
                          'class'=>'form-inline',
                        )
)); ?>



  <?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:350px',"id"=>"idObraSocial"),
  'attribute'=>'idObraSocial',
  "name"=>"idObraSocial",

  'data'=>CHtml::listData(ObrasSociales::model()->findAll(array('order'=>'nombreOs')), 'id', 'nombreOs')
)
); ?>


		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Buscar',
		)); ?>


<?php $this->endWidget(); ?>
