<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigoInterno')); ?>:</b>
	<?php echo CHtml::encode($data->codigoInterno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigoExterno')); ?>:</b>
	<?php echo CHtml::encode($data->codigoExterno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('detalle')); ?>:</b>
	<?php echo CHtml::encode($data->detalle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('importe')); ?>:</b>
	<?php echo CHtml::encode($data->importe); ?>
	<br />


</div>